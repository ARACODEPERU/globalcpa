<?php

namespace Tests\Unit\Modules\Commercial;

use App\Mail\CommercialNegotiationConfirmedMail;
use App\Models\Person;
use App\Models\User;
use App\Support\MailSender;
use Modules\Commercial\Database\Seeders\CommercialDatabaseSeeder;
use Modules\Commercial\Entities\CommercialNegotiation;
use Modules\Commercial\Entities\CommercialNegotiationInvoice;
use Modules\Commercial\Entities\CommercialNegotiationItem;
use Modules\Commercial\Support\NegotiationConfirmedRecipients;
use Tests\TestCase;

/*
 * Cuando el cliente abre el enlace de su negociacion y envia sus datos con el
 * voucher de su pago, el equipo tiene que enterarse para continuar con el proceso
 * de 9 pasos: el aviso va al asesor que creo la negociacion, a TODOS los usuarios
 * con rol administrador del modulo y al buzon de administracion del .env (MAIL_ADMIN).
 *
 * Estas pruebas cubren las piezas que pueden fallar en silencio: a quien se le envia
 * (destinatarios unicos y validos, con respaldo si el .env esta vacio), que el
 * controlador realmente dispare el envio, y que el correo se pueda RENDERIZAR. Lo
 * ultimo no es teorico: la plantilla que referenciaba el mailable no existia, el
 * worker solo dejaba un "FAIL" y el aviso no llegaba a nadie.
 */
class NegotiationConfirmedNotificationTest extends TestCase
{
    private const CONTROLLER = 'Modules/Commercial/Http/Controllers/CommercialNegotiationPublicController.php';
    private const RECIPIENTS = 'Modules/Commercial/Support/NegotiationConfirmedRecipients.php';
    private const MAILABLE = 'app/Mail/CommercialNegotiationConfirmedMail.php';
    private const VIEW = 'resources/views/emails/commercial_negotiation_confirmed.blade.php';
    private const SERVICES = 'config/services.php';

    public function test_los_destinatarios_son_los_administradores_mas_el_asesor(): void
    {
        $emails = NegotiationConfirmedRecipients::merge(
            ['admin1@globalcpa.com', 'admin2@globalcpa.com'],
            'asesor@globalcpa.com'
        );

        $this->assertSame(
            ['admin1@globalcpa.com', 'admin2@globalcpa.com', 'asesor@globalcpa.com'],
            $emails
        );
    }

    public function test_el_asesor_que_es_administrador_recibe_un_solo_correo(): void
    {
        $emails = NegotiationConfirmedRecipients::merge(
            ['admin1@globalcpa.com', 'asesor@globalcpa.com'],
            'asesor@globalcpa.com'
        );

        $this->assertSame(['admin1@globalcpa.com', 'asesor@globalcpa.com'], $emails);
        $this->assertCount(2, $emails);
    }

    public function test_los_correos_se_normalizan_y_los_invalidos_no_entran(): void
    {
        $emails = NegotiationConfirmedRecipients::merge(
            ['  Admin1@GlobalCPA.com  ', '', 'sin-arroba', null, 'admin1@globalcpa.com'],
            '   '
        );

        $this->assertSame(
            ['admin1@globalcpa.com'],
            $emails,
            'Un destinatario invalido hace fallar el envio completo y ese correo se pierde.'
        );
    }

    public function test_sin_administradores_sigue_avisando_al_asesor(): void
    {
        $emails = NegotiationConfirmedRecipients::merge([], 'asesor@globalcpa.com');

        $this->assertSame(['asesor@globalcpa.com'], $emails);
    }

    public function test_los_administradores_se_buscan_por_los_roles_del_modulo(): void
    {
        $source = $this->read(self::RECIPIENTS);

        $this->assertStringContainsString(
            '->role(CommercialDatabaseSeeder::ADMIN_ROLES)',
            $source,
            'Los roles administradores salen del seeder del modulo para que el aviso coincida con quienes pueden verificar la negociacion.'
        );
        $this->assertStringContainsString('$negotiation->creator?->email', $source);
        $this->assertStringContainsString(
            'self::withAdminAddress($adminEmails)',
            $source,
            'El buzon del .env se suma a los administradores por rol.'
        );
        $this->assertContains('Administrador', CommercialDatabaseSeeder::ADMIN_ROLES);
    }

    public function test_el_buzon_de_administracion_del_env_entra_en_los_destinatarios(): void
    {
        config(['services.email.admin_address' => 'buzon@globalcpa.com']);

        $conBuzon = NegotiationConfirmedRecipients::withAdminAddress(['admin1@globalcpa.com']);

        $this->assertSame(['admin1@globalcpa.com', 'buzon@globalcpa.com'], $conBuzon);

        // Y pasa por la misma depuracion que el resto: formato valido y sin repetidos.
        $this->assertSame(
            ['admin1@globalcpa.com', 'buzon@globalcpa.com', 'asesor@globalcpa.com'],
            NegotiationConfirmedRecipients::merge($conBuzon, 'asesor@globalcpa.com')
        );
    }

    public function test_sin_correo_configurado_se_usa_el_buzon_de_respaldo(): void
    {
        foreach ([null, '', '   ', 'no-es-un-correo'] as $valor) {
            config(['services.email.admin_address' => $valor]);

            $this->assertSame(
                'jsuclupe@globalcpaperu.com',
                MailSender::adminAddress(),
                'Un MAIL_ADMIN ausente o mal escrito dejaria el aviso sin destinatario.'
            );

            $this->assertSame(
                ['jsuclupe@globalcpaperu.com'],
                NegotiationConfirmedRecipients::merge(
                    NegotiationConfirmedRecipients::withAdminAddress([]),
                    null
                )
            );
        }
    }

    public function test_el_correo_configurado_en_el_env_manda_sobre_el_respaldo(): void
    {
        config(['services.email.admin_address' => '  avisos@globalcpa.com  ']);

        $this->assertSame('avisos@globalcpa.com', MailSender::adminAddress());
        $this->assertNotSame('jsuclupe@globalcpaperu.com', MailSender::adminAddress());
    }

    public function test_el_buzon_no_duplica_si_coincide_con_un_administrador(): void
    {
        config(['services.email.admin_address' => 'admin1@globalcpa.com']);

        $emails = NegotiationConfirmedRecipients::merge(
            NegotiationConfirmedRecipients::withAdminAddress(['admin1@globalcpa.com']),
            null
        );

        $this->assertSame(['admin1@globalcpa.com'], $emails);
    }

    public function test_services_declara_la_variable_mail_admin(): void
    {
        $services = $this->read(self::SERVICES);

        $this->assertStringContainsString(
            "'admin_address' => env('MAIL_ADMIN')",
            $services,
            'MAIL_ADMIN se lee desde config/services.php, no con env() disperso.'
        );
    }

    public function test_el_controlador_avisa_a_cada_destinatario_al_confirmar(): void
    {
        $controller = $this->read(self::CONTROLLER);
        $body = $this->methodBody($controller, 'private function notifyNegotiationRecipients(', "\n    }\n");

        $this->assertStringContainsString('$this->notifyNegotiationRecipients($negotiation, $person);', $controller);
        $this->assertStringNotContainsString('notifyAsesor', $controller, 'El aviso ya no es solo para el asesor.');
        $this->assertStringNotContainsString(
            "User::role('Administrador')",
            $controller,
            'Buscar solo por el rol "Administrador" dejaba fuera a los usuarios con rol "admin", que tienen el mismo permiso de verificacion.'
        );
        $this->assertStringContainsString('NegotiationConfirmedRecipients::forNegotiation($negotiation)', $body);
        $this->assertStringContainsString('foreach ($recipients as $email)', $body);
        $this->assertStringContainsString('Mail::to($email)->queue(new CommercialNegotiationConfirmedMail($negotiation, $client))', $body);
        $this->assertStringContainsString(
            'Log::warning(',
            $body,
            'Sin destinatarios el aviso no sale: tiene que quedar registrado.'
        );
    }

    /**
     * El render real es la unica prueba que detecta una plantilla ausente o rota, que
     * fue justo lo que dejo el correo sin enviar. No toca la base de datos: las
     * relaciones que la plantilla consulta se fijan a mano.
     */
    public function test_el_correo_se_renderiza_con_el_enlace_a_la_negociacion(): void
    {
        $negotiation = $this->negotiation();

        $mailable = new CommercialNegotiationConfirmedMail($negotiation, $this->client());
        $html = $mailable->render();

        $this->assertStringContainsString('/commercial/negotiations/show/' . $negotiation->id, $mailable->reviewUrl);
        $this->assertStringContainsString('/commercial/negotiations/show/' . $negotiation->id, $html);
        $this->assertStringContainsString('Nueva negociacion confirmada', $html);
        $this->assertStringContainsString('Juan Perez', $html);
        $this->assertStringContainsString('12345678', $html);
        $this->assertStringContainsString('juan@globalcpa.com', $html);
        $this->assertStringContainsString('999888777', $html);
        $this->assertStringContainsString('Paquete CPA 2026', $html);
        $this->assertStringContainsString('Curso de Auditoria', $html);
        $this->assertStringContainsString('PEN 1,200.00', $html);
        $this->assertStringContainsString('Boleta electronica', $html);
    }

    public function test_el_correo_muestra_el_ruc_cuando_el_comprobante_es_factura(): void
    {
        $negotiation = $this->negotiation();
        $negotiation->setRelation('invoice', new CommercialNegotiationInvoice([
            'invoice_type' => 'factura',
            'ruc' => '20123456789',
            'razon_social' => 'ACME SAC',
        ]));

        $html = (new CommercialNegotiationConfirmedMail($negotiation, $this->client()))->render();

        $this->assertStringContainsString('Factura electronica', $html);
        $this->assertStringContainsString('20123456789', $html);
    }

    public function test_la_plantilla_del_correo_existe_y_es_la_que_usa_el_mailable(): void
    {
        $this->assertFileExists(
            base_path(self::VIEW),
            'Sin esta plantilla el render lanza y el aviso encolado falla en silencio.'
        );
        $this->assertStringContainsString(
            "view: 'emails.commercial_negotiation_confirmed'",
            $this->read(self::MAILABLE)
        );
    }

    /**
     * El enlace lo resuelve el mailable (con respaldo si el nombre de ruta no esta
     * publicado): una ruta fragil dentro de la plantilla dejaria el correo sin salir,
     * como ya paso con una cache de rutas anterior a habilitar el modulo.
     */
    public function test_la_plantilla_usa_el_enlace_ya_resuelto(): void
    {
        $view = $this->read(self::VIEW);

        $this->assertStringContainsString('{{ $reviewUrl }}', $view);
        $this->assertStringNotContainsString('route(', $view, 'La plantilla no debe resolver rutas por su cuenta.');

        $mailable = $this->read(self::MAILABLE);

        $this->assertStringContainsString("route('comm_negotiations_show'", $mailable);
        $this->assertStringContainsString('public $reviewUrl;', $mailable);
    }

    public function test_el_mailable_registra_el_error_cuando_el_envio_falla(): void
    {
        $mailable = $this->read(self::MAILABLE);

        $this->assertStringContainsString('public function failed(\Throwable $e): void', $mailable);
        $this->assertStringContainsString('Log::error(', $mailable);
        $this->assertStringContainsString("'negotiation_id' => \$this->negotiation?->id", $mailable);
    }

    private function negotiation(): CommercialNegotiation
    {
        $negotiation = new CommercialNegotiation([
            'title' => 'Paquete CPA 2026',
            'total_price' => 1200,
            'currency' => 'PEN',
            'payment_method' => 'yape',
            'contact_detail' => 'Ana Asesora',
            'status' => 'confirmada',
        ]);

        $negotiation->id = 7;
        $negotiation->setRelation('creator', new User(['name' => 'Ana Asesora', 'email' => 'ana@globalcpa.com']));
        $negotiation->setRelation('items', collect([
            new CommercialNegotiationItem(['title' => 'Curso de Auditoria', 'price' => 700]),
            new CommercialNegotiationItem(['title' => 'Curso de Tributacion', 'price' => 500]),
        ]));

        // Sin comprobante (lo habitual en un cliente que paga por Yape): la plantilla
        // lo presenta como boleta electronica.
        $negotiation->setRelation('invoice', null);

        return $negotiation;
    }

    private function client(): Person
    {
        return new Person([
            'full_name' => 'Juan Perez',
            'number' => '12345678',
            'document_type_id' => 1,
            'email' => 'juan@globalcpa.com',
            'telephone' => '999888777',
            'ubigeo_description' => 'LIMA - LIMA - MIRAFLORES',
        ]);
    }

    private function methodBody(string $source, string $from, string $to): string
    {
        $start = strpos($source, $from);

        $this->assertNotFalse($start, "No se encontro el metodo: $from");

        $end = strpos($source, $to, $start);

        $this->assertNotFalse($end, "No se encontro el limite del metodo: $to");

        return substr($source, $start, $end - $start);
    }

    private function read(string $relativePath): string
    {
        $path = base_path($relativePath);

        $this->assertFileExists($path);

        // El controlador del modulo esta guardado con CRLF: se normaliza para que las
        // busquedas por bloques no dependan del fin de linea del archivo.
        return str_replace("\r\n", "\n", file_get_contents($path));
    }
}

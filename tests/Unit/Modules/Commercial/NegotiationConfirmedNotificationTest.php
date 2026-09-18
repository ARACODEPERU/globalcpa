<?php

namespace Tests\Unit\Modules\Commercial;

use App\Mail\CommercialNegotiationConfirmedMail;
use App\Models\Person;
use App\Models\User;
use Modules\Commercial\Database\Seeders\CommercialDatabaseSeeder;
use Modules\Commercial\Entities\CommercialNegotiation;
use Modules\Commercial\Entities\CommercialNegotiationItem;
use Modules\Commercial\Support\NegotiationConfirmedRecipients;
use Tests\TestCase;

/*
 * Cuando el cliente abre el enlace de su negociacion y envia sus datos, el equipo
 * tiene que enterarse para continuar con el proceso de 9 pasos: el aviso va al asesor
 * que creo la negociacion y a TODOS los usuarios con rol administrador.
 *
 * Estas pruebas cubren las tres piezas que pueden fallar en silencio: a quien se le
 * envia (destinatarios unicos y validos), que el controlador realmente dispare el
 * envio, y que el correo se pueda RENDERIZAR. Lo ultimo no es teorico: la vista
 * referenciada por el mailable no existia en el repositorio, asi que el try/catch del
 * controlador se tragaba el error y no llegaba ningun correo a nadie.
 */
class NegotiationConfirmedNotificationTest extends TestCase
{
    private const CONTROLLER = 'Modules/Commercial/Http/Controllers/CommercialNegotiationPublicController.php';
    private const RECIPIENTS = 'Modules/Commercial/Support/NegotiationConfirmedRecipients.php';
    private const MAILABLE = 'app/Mail/CommercialNegotiationConfirmedMail.php';
    private const VIEW = 'Modules/Commercial/Resources/views/emails/commercial-negotiation-confirmed.blade.php';

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
        $this->assertContains('Administrador', CommercialDatabaseSeeder::ADMIN_ROLES);
    }

    public function test_el_controlador_avisa_a_cada_destinatario_al_confirmar(): void
    {
        $controller = $this->read(self::CONTROLLER);
        $body = $this->methodBody($controller, 'private function notifyConfirmed(', "\n    }\n");

        $this->assertStringContainsString('$this->notifyConfirmed($negotiation, $person);', $controller);
        $this->assertStringNotContainsString('notifyAsesor', $controller, 'El aviso ya no es solo para el asesor.');
        $this->assertStringContainsString('NegotiationConfirmedRecipients::forNegotiation($negotiation)', $body);
        $this->assertStringContainsString('foreach ($recipients as $email)', $body);
        $this->assertStringContainsString('Mail::to($email)->send(new CommercialNegotiationConfirmedMail($negotiation, $client))', $body);
    }

    /**
     * El mailable referenciaba 'emails.commercial_negotiation_confirmed', una vista que
     * nunca se creo en el repositorio: el try/catch del controlador ocultaba el error y
     * el aviso no llegaba a nadie. El render real es la unica prueba que lo detecta.
     */
    public function test_el_correo_se_renderiza_con_el_enlace_al_proceso(): void
    {
        $negotiation = $this->negotiation();
        $client = new Person([
            'full_name' => 'Juan Perez',
            'number' => '12345678',
            'email' => 'juan@globalcpa.com',
            'telephone' => '999888777',
            'ubigeo_description' => 'LIMA - LIMA - MIRAFLORES',
        ]);

        $mailable = new CommercialNegotiationConfirmedMail($negotiation, $client);
        $html = $mailable->render();

        $this->assertStringContainsString('/commercial/negotiations/process/' . $negotiation->id, $mailable->processUrl);
        $this->assertStringContainsString('Continuar con el proceso', $html);
        $this->assertStringContainsString('/commercial/negotiations/process/' . $negotiation->id, $html);
        $this->assertStringContainsString('Juan Perez', $html);
        $this->assertStringContainsString('12345678', $html);
        $this->assertStringContainsString('juan@globalcpa.com', $html);
        $this->assertStringContainsString('Ana Asesora', $html);
        $this->assertStringContainsString('TOTAL A PAGAR', $html);
    }

    public function test_la_vista_del_correo_vive_dentro_del_modulo(): void
    {
        $this->assertFileExists(base_path(self::VIEW));
        $this->assertStringContainsString(
            "view: 'commercial::emails.commercial-negotiation-confirmed'",
            $this->read(self::MAILABLE)
        );
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

        return $negotiation;
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

        return file_get_contents($path);
    }
}

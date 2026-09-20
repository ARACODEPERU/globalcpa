<?php

namespace Tests\Unit\Support;

use App\Support\MailSender;
use Tests\TestCase;

/*
 * El buzon de administracion (MAIL_ADMIN) alimenta los avisos operativos, como la
 * negociacion confirmada del modulo Commercial. Si el .env no trae un correo util el
 * aviso no puede quedarse sin destinatario, asi que MailSender aplica un respaldo.
 */
class MailSenderTest extends TestCase
{
    public function test_el_buzon_de_administracion_sale_de_config_services(): void
    {
        config(['services.email.admin_address' => 'avisos@globalcpa.com']);

        $this->assertSame('avisos@globalcpa.com', MailSender::adminAddress());
    }

    public function test_el_correo_configurado_se_limpia(): void
    {
        config(['services.email.admin_address' => '  avisos@globalcpa.com  ']);

        $this->assertSame('avisos@globalcpa.com', MailSender::adminAddress());
    }

    public function test_sin_valor_util_se_usa_el_buzon_de_respaldo(): void
    {
        foreach ([null, '', '   ', 'no-es-un-correo', 'sin@dominio'] as $valor) {
            config(['services.email.admin_address' => $valor]);

            $this->assertSame(
                MailSender::FALLBACK_ADMIN_ADDRESS,
                MailSender::adminAddress(),
                'Un MAIL_ADMIN ausente o mal escrito dejaria el aviso sin destinatario.'
            );
        }

        $this->assertSame('jsuclupe@globalcpaperu.com', MailSender::FALLBACK_ADMIN_ADDRESS);
    }

    public function test_el_remitente_sigue_usando_su_propio_respaldo(): void
    {
        config(['mail.from.address' => 'hello@example.com']);

        $this->assertSame('informes@globalcpaperu.com', MailSender::address());

        config(['mail.from.address' => 'contacto@globalcpa.com']);

        $this->assertSame('contacto@globalcpa.com', MailSender::address());
    }
}

<?php

namespace Tests\Unit\Modules\Academic;

use Modules\Academic\Emails\StudentElectronicTicket;
use Tests\TestCase;

class StudentElectronicTicketTest extends TestCase
{
    public function test_el_correo_se_renderiza_si_el_detalle_del_documento_no_esta_disponible(): void
    {
        $html = (new StudentElectronicTicket([
            'for_name' => 'Juan Perez',
            'for_mail' => 'juan@example.com',
            'title' => 'Comprobante de pago',
        ]))->render();

        $this->assertStringContainsString('Juan Perez', $html);
        $this->assertStringContainsString(
            'El detalle de la venta no está disponible. El comprobante se encuentra adjunto.',
            $html
        );
    }

    public function test_el_mailable_revierte_email_sent_si_falla(): void
    {
        $source = file_get_contents(base_path('Modules/Academic/Emails/StudentElectronicTicket.php'));
        $jobSource = file_get_contents(base_path('Modules/Academic/Jobs/SendStudentElectronicTicketJob.php'));
        $controllerSource = file_get_contents(base_path('Modules/Academic/Http/Controllers/AcaSaleDocumentController.php'));

        $this->assertStringContainsString("['email_sent' => false]", $source);
        $this->assertStringContainsString("['email_sent' => false]", $jobSource);
        $this->assertStringContainsString('SendStudentElectronicTicketJob', $controllerSource);
        $this->assertStringNotContainsString("'email_sent' => true", $controllerSource);
    }
}

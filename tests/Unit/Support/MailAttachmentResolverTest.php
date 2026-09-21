<?php

namespace Tests\Unit\Support;

use App\Support\MailAttachmentResolver;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use Tests\TestCase;

class MailAttachmentResolverTest extends TestCase
{
    public function test_resuelve_un_adjunto_desde_storage_y_sanitiza_el_nombre(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('mail/comprobante.pdf', 'pdf');

        $attachment = MailAttachmentResolver::required(
            'mail/comprobante.pdf',
            '../comprobante cliente.pdf',
            'public',
        );

        $this->assertInstanceOf(Attachment::class, $attachment);
        $this->assertNotNull($attachment);
    }

    public function test_un_adjunto_opcional_inexistente_se_omite(): void
    {
        Storage::fake('public');

        $this->assertNull(
            MailAttachmentResolver::optional('mail/no-existe.xml', 'documento.xml', 'public')
        );
    }

    public function test_un_adjunto_obligatorio_inexistente_falla_con_un_error_claro(): void
    {
        Storage::fake('public');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('El adjunto requerido no existe');

        MailAttachmentResolver::required('mail/no-existe.pdf', 'documento.pdf', 'public');
    }

    public function test_no_permite_rutas_absolutas_fuera_del_almacenamiento(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('fuera del almacenamiento permitido');

        MailAttachmentResolver::required(__FILE__, 'test.php');
    }
}

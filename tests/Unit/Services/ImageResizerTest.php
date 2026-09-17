<?php

namespace Tests\Unit\Services;

use App\Services\ImageResizer;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

/*
 * El navegador ya reduce las imagenes antes de subirlas (resources/js/utils/imageResize.js),
 * pero el backend debe garantizar el mismo tope para cualquier subida: otro navegador,
 * una API, o cuando el usuario guarda antes de que el navegador termine de redimensionar.
 * Estas pruebas fijan ese contrato: 440px de ancho maximo, alto proporcional, sin agrandar.
 */
class ImageResizerTest extends TestCase
{
    private const DESTINATION = 'uploads/test';

    protected function setUp(): void
    {
        parent::setUp();

        Storage::fake('public');
    }

    public function test_reduce_la_imagen_a_440px_de_ancho_con_el_alto_proporcional(): void
    {
        $file = $this->fakeImage(800, 400);

        $path = ImageResizer::store($file, self::DESTINATION, 'foto.jpg');

        $this->assertSame(self::DESTINATION . '/foto.jpg', $path);

        [$width, $height] = $this->dimensions($path);

        $this->assertSame(440, $width);
        $this->assertSame(220, $height);
    }

    public function test_no_agranda_una_imagen_mas_angosta(): void
    {
        $file = $this->fakeImage(300, 150);

        $path = ImageResizer::store($file, self::DESTINATION, 'pequena.jpg');

        [$width, $height] = $this->dimensions($path);

        $this->assertSame(300, $width);
        $this->assertSame(150, $height);
    }

    public function test_guarda_los_svg_sin_tocarlos(): void
    {
        // Rasterizar un SVG perderia el vector y sus dimensiones propias.
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="600">'
            . '<rect width="1200" height="600" fill="#002060"/></svg>';
        $file = UploadedFile::fake()->createWithContent('logo.svg', $svg);

        $path = ImageResizer::store($file, self::DESTINATION, 'logo.svg');

        $this->assertSame($svg, Storage::disk('public')->get($path));
    }

    public function test_guarda_los_archivos_que_no_son_imagen_sin_tocarlos(): void
    {
        // El CMS sube por el mismo formulario imagenes, videos y documentos.
        $file = UploadedFile::fake()->createWithContent('contrato.pdf', '%PDF-1.4 contenido del contrato');

        $path = ImageResizer::store($file, self::DESTINATION, 'contrato.pdf');

        $this->assertSame('%PDF-1.4 contenido del contrato', Storage::disk('public')->get($path));
    }

    public function test_devuelve_la_ruta_relativa_igual_que_store_as(): void
    {
        $file = $this->fakeImage(1200, 300);

        $path = ImageResizer::store($file, self::DESTINATION, 'ancha.jpg');

        $this->assertSame(self::DESTINATION . '/ancha.jpg', $path);
        $this->assertTrue(Storage::disk('public')->exists($path));
        // 1200 x 300 es 4:1, al reducir a 440 de ancho el alto debe quedar en 110.
        $this->assertSame([440, 110], $this->dimensions($path));
    }

    /**
     * Nombre unico con la extension real: el mismo estilo que UploadedFile::store().
     */
    public function test_genera_un_nombre_unico_con_la_extension_real(): void
    {
        $file = $this->fakeImage(100, 100);

        $name = ImageResizer::makeFileName($file);

        $this->assertSame(40, strlen(pathinfo($name, PATHINFO_FILENAME)));
        $this->assertSame('jpg', pathinfo($name, PATHINFO_EXTENSION));
    }

    private function fakeImage(int $width, int $height): UploadedFile
    {
        $path = tempnam(sys_get_temp_dir(), 'img') . '.jpg';

        $image = imagecreatetruecolor($width, $height);
        imagefill($image, 0, 0, imagecolorallocate($image, 0, 32, 96));
        imagejpeg($image, $path, 90);
        imagedestroy($image);

        return new UploadedFile($path, 'prueba.jpg', 'image/jpeg', null, true);
    }

    private function dimensions(string $path): array
    {
        $size = getimagesize(Storage::disk('public')->path($path));

        return [(int) $size[0], (int) $size[1]];
    }
}

<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

/**
 * Guarda en disco las imagenes subidas reduciendolas a un ancho maximo.
 *
 * El navegador ya las reduce antes de enviarlas (resources/js/utils/imageResize.js);
 * este tope es la red de seguridad para cualquier subida que llegue sin reducir:
 * otro navegador, una API, o cuando el usuario guarda antes de que el navegador
 * termine de redimensionar.
 */
class ImageResizer
{
    /** Ancho maximo permitido, en pixeles. El alto se ajusta en proporcion. */
    public const MAX_WIDTH = 440;

    /** Formatos que se pueden escalar. SVG y GIF se guardan tal cual. */
    private const RESIZABLE_MIMES = ['image/jpeg', 'image/png', 'image/webp'];

    /**
     * Guarda la imagen en el disco indicado y devuelve la ruta relativa, igual
     * que haria UploadedFile::storeAs(). Si no se puede procesar, guarda el
     * archivo original.
     */
    public static function store(UploadedFile $file, string $destination, string $fileName, string $disk = 'public'): string
    {
        $destination = trim($destination, '/');
        $path = $destination . '/' . $fileName;

        try {
            if (! static::isResizable($file)) {
                return $file->storeAs($destination, $fileName, $disk);
            }

            $image = Image::make($file->getRealPath());

            if ($image->width() > static::MAX_WIDTH) {
                $image->resize(static::MAX_WIDTH, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            }

            $fullPath = Storage::disk($disk)->path($path);

            if (! is_dir(dirname($fullPath))) {
                Storage::disk($disk)->makeDirectory($destination);
            }

            $image->save($fullPath, 85);

            return $path;
        } catch (\Throwable $e) {
            // Ante cualquier problema (formato raro, GD sin soporte) se guarda el original.
            return $file->storeAs($destination, $fileName, $disk);
        }
    }

    /**
     * Nombre unico con la extension real del archivo, con el mismo estilo que
     * usa UploadedFile::store().
     */
    public static function makeFileName(UploadedFile $file): string
    {
        $extension = $file->guessExtension() ?: $file->getClientOriginalExtension();

        return Str::random(40) . '.' . $extension;
    }

    private static function isResizable(UploadedFile $file): bool
    {
        $mime = $file->getMimeType();

        return in_array($mime, static::RESIZABLE_MIMES, true)
            && function_exists('imagecreatefromstring');
    }
}

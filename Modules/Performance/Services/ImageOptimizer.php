<?php

namespace Modules\Performance\Services;

use Intervention\Image\Facades\Image;

class ImageOptimizer
{
    public function __construct(protected ImageRepository $repository)
    {
    }

    /**
     * Redimensiona imagenes manteniendo siempre el mismo nombre y extension.
     *
     * @param  array<int, array{root?:string, file?:string}>  $targets
     * @param  array{mode?:string, percent?:int, width?:int, quality?:int}  $options
     * @return array{processed:int, skipped:array, before:int, after:int}
     */
    public function resize(array $targets, array $options): array
    {
        $mode = $options['mode'] ?? 'percent';
        $percent = (int) ($options['percent'] ?? 80);
        $maxWidth = (int) ($options['width'] ?? 1280);
        $quality = (int) ($options['quality'] ?? config('performance.quality.default', 82));
        $quality = max((int) config('performance.quality.min', 55), min((int) config('performance.quality.max', 95), $quality));

        $summary = [
            'processed' => 0,
            'skipped' => [],
            'before' => 0,
            'after' => 0,
        ];

        foreach ($targets as $target) {
            $root = $this->repository->rootByKey((string) ($target['root'] ?? ''));
            $relative = str_replace('\\', '/', (string) ($target['file'] ?? ''));

            if (!$root || $relative === '' || str_contains($relative, '..')) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'Archivo no valido'];

                continue;
            }

            $abs = str_replace('\\', '/', $root['abs'].'/'.$relative);
            $real = @realpath($abs);
            $rootReal = @realpath($root['abs']);

            if (!$real || !$rootReal || !str_starts_with(str_replace('\\', '/', $real), str_replace('\\', '/', $rootReal))) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'No existe o esta fuera de la carpeta permitida'];

                continue;
            }

            $real = str_replace('\\', '/', $real);
            $extension = strtolower(pathinfo($real, PATHINFO_EXTENSION));

            if (!in_array($extension, config('performance.resizable_extensions', []), true)) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'Formato no soportado para redimensionar'];

                continue;
            }

            $dimensions = @getimagesize($real);

            if (!$dimensions) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'No se pudo leer la imagen'];

                continue;
            }

            [$currentWidth] = $dimensions;
            $currentWidth = (int) $currentWidth;
            $targetWidth = $mode === 'width'
                ? $maxWidth
                : (int) round($currentWidth * ($percent / 100));

            if ($currentWidth <= 0 || $targetWidth >= $currentWidth) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'Ya es igual o mas pequena que el tamano solicitado'];

                continue;
            }

            if ($targetWidth < 40) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'El nuevo ancho es demasiado pequeno'];

                continue;
            }

            $sizeBefore = (int) @filesize($real);

            try {
                $this->backup($root, $relative, $real);

                Image::make($real)
                    ->resize($targetWidth, null, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->save($real, $quality);

                clearstatcache(true, $real);

                $summary['before'] += $sizeBefore;
                $summary['after'] += (int) @filesize($real);
                $summary['processed']++;
            } catch (\Throwable $exception) {
                $summary['skipped'][] = ['file' => $relative, 'reason' => 'Error al procesar: '.$exception->getMessage()];
            }
        }

        return $summary;
    }

    /**
     * Copia de seguridad en storage/app/performance-backups antes de sobrescribir.
     */
    protected function backup(array $root, string $relative, string $abs): void
    {
        $backupBase = storage_path('app/'.config('performance.backup_path', 'performance-backups'));
        $safeRoot = str_replace([':', '\\'], ['_', '/'], (string) $root['key']);
        $destination = $backupBase.'/'.date('Y-m-d').'/'.$safeRoot.'/'.$relative;

        if (is_file($destination)) {
            return;
        }

        $directory = dirname($destination);

        if (!is_dir($directory)) {
            @mkdir($directory, 0775, true);
        }

        @copy($abs, $destination);
    }
}

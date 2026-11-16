<?php

namespace Modules\Performance\Services;

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ImageTools
{
    public function __construct(protected ImageRepository $repository)
    {
    }

    /**
     * Grupos de archivos con contenido identico dentro de una pestaña.
     */
    public function duplicates(string $tabKey): array
    {
        $groups = [];

        foreach ($this->repository->scan($tabKey) as $item) {
            if ($item['bytes'] <= 0) {
                continue;
            }

            $abs = $this->absolute($item['root'], $item['file']);

            if (!$abs) {
                continue;
            }

            $hash = @md5_file($abs);

            if (!$hash) {
                continue;
            }

            $groups[$hash][] = [
                'id' => $item['id'],
                'root' => $item['root'],
                'file' => $item['file'],
                'name' => $item['name'],
                'url' => $item['url'],
                'bytes' => $item['bytes'],
                'root_label' => $item['root_label'],
                'usages' => count($item['usages']),
            ];
        }

        $duplicates = array_values(array_filter($groups, fn ($group) => count($group) > 1));

        usort($duplicates, fn ($a, $b) => $b[0]['bytes'] <=> $a[0]['bytes']);

        return $duplicates;
    }

    /**
     * Genera una copia WebP junto a cada imagen, sin tocar el archivo original.
     */
    public function generateWebp(array $targets, int $quality = 80): array
    {
        $summary = ['created' => 0, 'skipped' => [], 'before' => 0, 'after' => 0];

        foreach ($targets as $target) {
            $rootKey = (string) ($target['root'] ?? '');
            $file = str_replace('\\', '/', (string) ($target['file'] ?? ''));
            $abs = $this->absolute($rootKey, $file);

            if (!$abs) {
                $summary['skipped'][] = ['file' => $file, 'reason' => 'Archivo no valido'];
                continue;
            }

            $extension = strtolower(pathinfo($abs, PATHINFO_EXTENSION));

            if (!in_array($extension, ['jpg', 'jpeg', 'png'], true)) {
                $summary['skipped'][] = ['file' => $file, 'reason' => 'Solo JPG y PNG se convierten a WebP'];
                continue;
            }

            $webp = preg_replace('~\.[a-z0-9]+$~i', '.webp', $abs);

            if (is_file($webp)) {
                $summary['skipped'][] = ['file' => $file, 'reason' => 'Ya existe el WebP'];
                continue;
            }

            try {
                $before = (int) @filesize($abs);
                Image::make($abs)->encode('webp', $quality)->save($webp);
                $summary['created']++;
                $summary['before'] += $before;
                $summary['after'] += (int) @filesize($webp);
            } catch (\Throwable $exception) {
                $summary['skipped'][] = ['file' => $file, 'reason' => 'Error: '.$exception->getMessage()];
            }
        }

        return $summary;
    }

    /**
     * Mueve archivos a una cuarentena reversible dentro de storage/app.
     */
    public function quarantine(array $targets): array
    {
        $summary = ['moved' => 0, 'skipped' => [], 'destination' => 'storage/app/performance-quarantine'];

        foreach ($targets as $target) {
            $rootKey = (string) ($target['root'] ?? '');
            $file = str_replace('\\', '/', (string) ($target['file'] ?? ''));
            $abs = $this->absolute($rootKey, $file);

            if (!$abs) {
                $summary['skipped'][] = ['file' => $file, 'reason' => 'Archivo no valido'];
                continue;
            }

            $safeRoot = str_replace([':', '\\'], ['_', '/'], $rootKey);
            $destination = storage_path('app/performance-quarantine/'.date('Y-m-d').'/'.$safeRoot.'/'.$file);
            $directory = dirname($destination);

            if (!is_dir($directory)) {
                @mkdir($directory, 0775, true);
            }

            try {
                if (!@rename($abs, $destination)) {
                    throw new \RuntimeException('No se pudo mover el archivo');
                }

                $summary['moved']++;
            } catch (\Throwable $exception) {
                $summary['skipped'][] = ['file' => $file, 'reason' => $exception->getMessage()];
            }
        }

        return $summary;
    }

    /**
     * Ruta absoluta validada dentro de la carpeta permitida.
     */
    public function absolute(string $rootKey, string $file): ?string
    {
        $root = $this->repository->rootByKey($rootKey);

        if (!$root || $file === '' || str_contains($file, '..')) {
            return null;
        }

        $abs = str_replace('\\', '/', $root['abs'].'/'.$file);
        $real = @realpath($abs);
        $rootReal = @realpath($root['abs']);

        if (!$real || !$rootReal) {
            return null;
        }

        $real = str_replace('\\', '/', $real);
        $rootReal = str_replace('\\', '/', $rootReal);

        return str_starts_with($real, $rootReal) ? $real : null;
    }

    /**
     * Indice de nombres de archivo existentes en las carpetas publicas.
     */
    public function existingBasenames(): array
    {
        $names = [];

        foreach ([storage_path('app/public'), public_path('img')] as $directory) {
            if (!is_dir($directory)) {
                continue;
            }

            foreach (File::allFiles($directory) as $file) {
                $names[strtolower($file->getFilename())] = true;
            }
        }

        return $names;
    }
}

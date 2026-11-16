<?php

namespace Modules\Performance\Services;

use Illuminate\Support\Facades\File;

class ImageRepository
{
    public function __construct(protected UsageResolver $usage)
    {
    }

    /**
     * Pestañas para el frontend.
     */
    public function tabs(): array
    {
        $tabs = [];

        foreach (config('performance.tabs', []) as $key => $tab) {
            $roots = [];

            foreach ($tab['roots'] ?? [] as $rawRoot) {
                $root = $this->resolveRoot($rawRoot);

                if ($root && is_dir($root['abs'])) {
                    $roots[] = [
                        'key' => $root['key'],
                        'label' => $root['label'],
                    ];
                }
            }

            $tabs[] = [
                'key' => $key,
                'label' => $tab['label'],
                'description' => $tab['description'] ?? '',
                'roots' => $roots,
            ];
        }

        return $tabs;
    }

    /**
     * Resuelve una carpeta configurada a ruta absoluta, clave y prefijo de URL.
     *
     * @return array{key:string,label:string,abs:string,url:string}|null
     */
    public function resolveRoot(string $rawRoot): ?array
    {
        $rawRoot = trim(str_replace('\\', '/', $rawRoot), '/');

        if ($rawRoot === '') {
            return null;
        }

        $isPublic = str_starts_with($rawRoot, '@public/');
        $relative = $isPublic ? substr($rawRoot, strlen('@public/')) : $rawRoot;

        $abs = $isPublic
            ? public_path($relative)
            : storage_path('app/public/'.$relative);

        $url = $isPublic
            ? '/'.$relative.'/'
            : '/storage/'.$relative.'/';

        $label = $isPublic
            ? 'public/'.$relative
            : 'storage/app/public/'.$relative;

        return [
            'key' => ($isPublic ? 'public:' : 'storage:').$relative,
            'label' => $label,
            'abs' => str_replace('\\', '/', $abs),
            'url' => $url,
        ];
    }

    /**
     * Resuelve una clave de carpeta (la que usa el frontend) a su definición.
     */
    public function rootByKey(string $key): ?array
    {
        foreach (config('performance.tabs', []) as $tab) {
            foreach ($tab['roots'] ?? [] as $rawRoot) {
                $root = $this->resolveRoot($rawRoot);

                if ($root && $root['key'] === $key) {
                    return $root;
                }
            }
        }

        return null;
    }

    /**
     * Lista las imagenes de una pestaña con tamaño, resolucion y usos.
     */
    public function scan(string $tabKey): array
    {
        $tabs = config('performance.tabs', []);
        $tab = $tabs[$tabKey] ?? null;

        if (!$tab) {
            return [];
        }

        $extensions = config('performance.image_extensions', []);
        $resizable = config('performance.resizable_extensions', []);
        $thresholdBytes = (int) config('performance.thresholds.bytes', 300 * 1024);
        $thresholdWidth = (int) config('performance.thresholds.width', 1920);

        $items = [];
        $seen = [];

        foreach ($tab['roots'] ?? [] as $rawRoot) {
            $root = $this->resolveRoot($rawRoot);

            if (!$root || !is_dir($root['abs'])) {
                continue;
            }

            foreach (File::allFiles($root['abs']) as $file) {
                $extension = strtolower($file->getExtension());

                if (!in_array($extension, $extensions, true)) {
                    continue;
                }

                $abs = str_replace('\\', '/', $file->getPathname());
                $real = @realpath($abs);
                $real = $real ? str_replace('\\', '/', $real) : $abs;

                if (isset($seen[$real])) {
                    continue;
                }

                $seen[$real] = true;

                $relative = ltrim(substr($abs, strlen(rtrim($root['abs'], '/'))), '/');
                $bytes = (int) @filesize($abs);
                $dimensions = @getimagesize($abs);

                $width = $dimensions ? (int) $dimensions[0] : null;
                $height = $dimensions ? (int) $dimensions[1] : null;

                $items[] = [
                    'id' => $root['key'].'|'.$relative,
                    'root' => $root['key'],
                    'root_label' => $root['label'],
                    'file' => $relative,
                    'name' => basename($relative),
                    'url' => $root['url'].implode('/', array_map('rawurlencode', explode('/', $relative))),
                    'extension' => $extension,
                    'width' => $width,
                    'height' => $height,
                    'bytes' => $bytes,
                    'modified' => date('Y-m-d H:i', (int) @filemtime($abs)),
                    'resizable' => in_array($extension, $resizable, true),
                    'webp' => is_file(preg_replace('~\.[a-z0-9]+$~i', '.webp', $abs)),
                    'needs_attention' => ($width !== null && $width > $thresholdWidth) || $bytes > $thresholdBytes,
                    'usages' => $this->usage->forFile(basename($relative)),
                ];
            }
        }

        usort($items, fn ($a, $b) => $b['bytes'] <=> $a['bytes']);

        return $items;
    }
}

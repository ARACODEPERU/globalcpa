<?php

namespace Modules\Performance\Services\Reports;

use Illuminate\Support\Facades\File;

class FrontendReport
{
    public function build(): array
    {
        $manifestPath = public_path('build/manifest.json');
        $assetsPath = public_path('build/assets');
        $cards = [];
        $sections = [];
        $notes = [];

        $manifest = [];
        $manifestAge = null;

        if (is_file($manifestPath)) {
            $manifest = json_decode((string) @file_get_contents($manifestPath), true) ?: [];
            $manifestAge = (int) @filemtime($manifestPath);
        }

        $chunks = [];
        $totalJs = 0;
        $totalCss = 0;

        foreach ($manifest as $entry => $data) {
            $files = array_merge([$data['file'] ?? null], $data['css'] ?? []);

            foreach ($files as $asset) {
                if (!$asset) {
                    continue;
                }

                $abs = public_path('build/'.$asset);

                if (!is_file($abs)) {
                    continue;
                }

                $bytes = (int) @filesize($abs);
                $isCss = str_ends_with($asset, '.css');
                $isCss ? $totalCss += $bytes : $totalJs += $bytes;

                $chunks[] = [
                    'entry' => $entry,
                    'asset' => $asset,
                    'size' => $this->formatBytes($bytes),
                    'type' => $isCss ? 'CSS' : 'JS',
                    'bytes' => $bytes,
                ];
            }
        }

        usort($chunks, fn ($a, $b) => $b['bytes'] <=> $a['bytes']);

        $assetFiles = is_dir($assetsPath) ? File::files($assetsPath) : [];
        $buildBytes = 0;
        foreach ($assetFiles as $file) {
            $buildBytes += (int) $file->getSize();
        }

        $isHot = is_file(public_path('hot'));

        $cards[] = [
            'label' => 'Peso del build',
            'value' => $this->formatBytes($buildBytes),
            'hint' => count($assetFiles).' archivos en public/build/assets',
            'status' => $buildBytes > 20 * 1024 * 1024 ? 'bad' : ($buildBytes > 10 * 1024 * 1024 ? 'warn' : 'ok'),
        ];

        $cards[] = [
            'label' => 'JavaScript',
            'value' => $this->formatBytes($totalJs),
            'hint' => 'Suma de entradas del manifest',
            'status' => $totalJs > 3 * 1024 * 1024 ? 'warn' : 'ok',
        ];

        $cards[] = [
            'label' => 'CSS',
            'value' => $this->formatBytes($totalCss),
            'hint' => 'Suma de entradas del manifest',
            'status' => 'ok',
        ];

        $cards[] = [
            'label' => 'Build',
            'value' => $isHot ? 'Vite dev' : ($manifestAge ? date('Y-m-d H:i', $manifestAge) : 'sin build'),
            'hint' => $isHot ? 'public/hot presente: assets servidos por dev server' : 'Compilado con vite build',
            'status' => $manifestAge || $isHot ? 'ok' : 'bad',
        ];

        $sourceFiles = $this->sourceFiles();
        $stale = $manifestAge && $sourceFiles > 0 && $sourceFiles > $manifestAge;

        $sections[] = [
            'title' => 'Chunks mas pesados',
            'columns' => [
                ['key' => 'asset', 'label' => 'Asset'],
                ['key' => 'entry', 'label' => 'Entrada'],
                ['key' => 'type', 'label' => 'Tipo'],
                ['key' => 'size', 'label' => 'Peso'],
            ],
            'rows' => array_slice(array_map(fn ($chunk) => [
                'asset' => $chunk['asset'],
                'entry' => $chunk['entry'],
                'type' => $chunk['type'],
                'size' => $chunk['size'],
            ], $chunks), 0, 15),
            'empty' => 'No hay manifest de build. Ejecuta npm run build.',
        ];

        $notes[] = $stale
            ? 'El build parece desactualizado: hay archivos fuente mas nuevos que public/build/manifest.json.'
            : 'El build esta al dia respecto a los archivos fuente.';

        $notes[] = 'Revisa los chunks mas grandes: suelen ser dependencias como editor, mapas o UI kits que se pueden cargar de forma diferida.';

        return [
            'key' => 'frontend',
            'title' => 'Peso del frontend',
            'description' => 'Tamano del build de Vite, chunks mas pesados y estado del manifest.',
            'cards' => $cards,
            'sections' => $sections,
            'notes' => $notes,
        ];
    }

    protected function sourceFiles(): int
    {
        $newest = 0;
        $directories = [resource_path('js'), resource_path('css')];

        foreach (glob(base_path('Modules/*/Resources/assets/js'), GLOB_ONLYDIR) ?: [] as $modulePath) {
            $directories[] = $modulePath;
        }

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                continue;
            }

            foreach (File::allFiles($directory) as $file) {
                $newest = max($newest, (int) $file->getMTime());
            }
        }

        return $newest;
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $bytes;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, $unit === 0 ? 0 : 1).' '.$units[$unit];
    }
}

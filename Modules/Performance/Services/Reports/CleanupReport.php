<?php

namespace Modules\Performance\Services\Reports;

use Illuminate\Support\Facades\File;

class CleanupReport
{
    /**
     * Carpetas temporales que se pueden limpiar de forma programada.
     */
    public function targets(): array
    {
        return config('performance.cleanup.targets', [
            ['label' => 'Certificados temporales', 'path' => storage_path('app/public/tmp_html_cert')],
            ['label' => 'QR temporales', 'path' => storage_path('app/public/tmp_qr')],
            ['label' => 'Vouchers de negociaciones', 'path' => storage_path('app/public/negotiations/vouchers')],
            ['label' => 'Backups de imagenes', 'path' => storage_path('app/performance-backups')],
            ['label' => 'Vistas compiladas', 'path' => storage_path('framework/views')],
        ]);
    }

    public function build(): array
    {
        $days = (int) config('performance.cleanup.days', 7);
        $rows = [];
        $totalBytes = 0;
        $totalOld = 0;
        $totalAll = 0;

        foreach ($this->targets() as $target) {
            $stats = $this->stats($target['path'], $days);
            $totalBytes += $stats['bytes'];
            $totalOld += $stats['old'];
            $totalAll += $stats['files'];

            $rows[] = [
                'label' => $target['label'],
                'path' => str_replace('\\', '/', str_replace(base_path().DIRECTORY_SEPARATOR, '', $target['path'])),
                'files' => (string) $stats['files'],
                'size' => $this->formatBytes($stats['bytes']),
                'old' => (string) $stats['old'],
                'old_size' => $this->formatBytes($stats['old_bytes']),
            ];
        }

        $cards = [
            [
                'label' => 'Archivos temporales',
                'value' => (string) $totalAll,
                'hint' => 'En '.count($rows).' carpetas',
                'status' => 'ok',
            ],
            [
                'label' => 'Peso total',
                'value' => $this->formatBytes($totalBytes),
                'hint' => 'Suma de todas las carpetas',
                'status' => $totalBytes > 500 * 1024 * 1024 ? 'warn' : 'ok',
            ],
            [
                'label' => 'Con mas de '.$days.' dias',
                'value' => (string) $totalOld,
                'hint' => 'Candidatos a eliminarse',
                'status' => $totalOld > 0 ? 'warn' : 'ok',
            ],
        ];

        return [
            'key' => 'cleanup',
            'title' => 'Limpieza',
            'description' => 'Archivos temporales y backups que se pueden eliminar de forma segura segun su antiguedad.',
            'cards' => $cards,
            'sections' => [
                [
                    'title' => 'Carpetas temporales',
                    'columns' => [
                        ['key' => 'label', 'label' => 'Carpeta'],
                        ['key' => 'path', 'label' => 'Ruta'],
                        ['key' => 'files', 'label' => 'Archivos'],
                        ['key' => 'size', 'label' => 'Peso'],
                        ['key' => 'old', 'label' => 'Mayores a '.$days.' d'],
                        ['key' => 'old_size', 'label' => 'Peso recuperable'],
                    ],
                    'rows' => $rows,
                    'empty' => 'No hay carpetas configuradas.',
                ],
            ],
            'notes' => [
                'Solo se eliminan archivos con mas de '.$days.' dias; los recientes se conservan.',
                'Las vistas compiladas se regeneran solas: borrarlas despues de un despliegue es seguro.',
            ],
            'action' => [
                'label' => 'Eliminar archivos de mas de '.$days.' dias',
                'url' => '/performance/cleanup/run',
                'confirm' => 'Se eliminaran los archivos indicados de las carpetas temporales. Esta accion no se puede deshacer.',
            ],
        ];
    }

    /**
     * Elimina archivos antiguos de las carpetas temporales.
     */
    public function run(): array
    {
        $days = (int) config('performance.cleanup.days', 7);
        $limit = time() - ($days * 86400);
        $deleted = 0;
        $bytes = 0;
        $failed = 0;

        foreach ($this->targets() as $target) {
            if (!is_dir($target['path'])) {
                continue;
            }

            foreach (File::allFiles($target['path']) as $file) {
                if ((int) $file->getMTime() > $limit) {
                    continue;
                }

                $size = (int) $file->getSize();

                if (@unlink($file->getPathname())) {
                    $deleted++;
                    $bytes += $size;
                } else {
                    $failed++;
                }
            }
        }

        return ['deleted' => $deleted, 'bytes' => $bytes, 'failed' => $failed, 'days' => $days];
    }

    protected function stats(string $directory, int $days): array
    {
        $stats = ['files' => 0, 'bytes' => 0, 'old' => 0, 'old_bytes' => 0];

        if (!is_dir($directory)) {
            return $stats;
        }

        $limit = time() - ($days * 86400);

        foreach (File::allFiles($directory) as $file) {
            $size = (int) $file->getSize();
            $stats['files']++;
            $stats['bytes'] += $size;

            if ((int) $file->getMTime() <= $limit) {
                $stats['old']++;
                $stats['old_bytes'] += $size;
            }
        }

        return $stats;
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

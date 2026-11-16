<?php

namespace Modules\Performance\Services\Reports;

use Illuminate\Support\Facades\File;

class CacheReport
{
    public function build(): array
    {
        $cards = [];
        $sections = [];
        $notes = [];

        $configCached = is_file(base_path('bootstrap/cache/config.php'));
        $routesCached = is_file(base_path('bootstrap/cache/routes-v7.php')) || is_file(base_path('bootstrap/cache/routes.php'));
        $eventsCached = is_file(base_path('bootstrap/cache/events.php'));
        $viewsPath = storage_path('framework/views');
        $views = is_dir($viewsPath) ? File::files($viewsPath) : [];
        $viewsBytes = 0;
        foreach ($views as $view) {
            $viewsBytes += (int) $view->getSize();
        }

        $cachePath = storage_path('framework/cache');
        $cacheBytes = $this->directorySize($cachePath);

        $logsBytes = 0;
        $logsPath = storage_path('logs');
        foreach (is_dir($logsPath) ? File::files($logsPath) : [] as $log) {
            $logsBytes += (int) $log->getSize();
        }

        $opcache = function_exists('opcache_get_status') ? @opcache_get_status(false) : null;
        $opcacheEnabled = is_array($opcache) && ($opcache['opcache_enabled'] ?? false);

        $cards[] = [
            'label' => 'Configuracion',
            'value' => $configCached ? 'Cacheada' : 'Sin cache',
            'hint' => $configCached ? 'bootstrap/cache/config.php presente' : 'Ejecuta php artisan config:cache',
            'status' => $configCached ? 'ok' : 'warn',
        ];

        $cards[] = [
            'label' => 'Rutas',
            'value' => $routesCached ? 'Cacheadas' : 'Sin cache',
            'hint' => $routesCached ? $this->routeCacheFile() : 'Ejecuta php artisan route:cache',
            'status' => $routesCached ? 'ok' : 'warn',
        ];

        $cards[] = [
            'label' => 'OPcache',
            'value' => $opcacheEnabled ? 'Activo' : 'Inactivo',
            'hint' => $opcacheEnabled ? 'Clases ya compiladas en memoria' : 'Activa opcache.enable en PHP',
            'status' => $opcacheEnabled ? 'ok' : 'bad',
        ];

        $cards[] = [
            'label' => 'Vistas compiladas',
            'value' => (string) count($views),
            'hint' => $this->formatBytes($viewsBytes),
            'status' => count($views) > 3000 ? 'warn' : 'ok',
        ];

        $cards[] = [
            'label' => 'Cache de framework',
            'value' => $this->formatBytes($cacheBytes),
            'hint' => 'storage/framework/cache',
            'status' => $cacheBytes > 200 * 1024 * 1024 ? 'warn' : 'ok',
        ];

        $cards[] = [
            'label' => 'Logs',
            'value' => $this->formatBytes($logsBytes),
            'hint' => 'storage/logs',
            'status' => $logsBytes > 100 * 1024 * 1024 ? 'warn' : 'ok',
        ];

        $rows = [
            ['setting' => 'Entorno', 'value' => app()->environment()],
            ['setting' => 'APP_DEBUG', 'value' => config('app.debug') ? 'true (no usar en produccion)' : 'false'],
            ['setting' => 'Driver de cache', 'value' => (string) config('cache.default')],
            ['setting' => 'Driver de sesion', 'value' => (string) config('session.driver')],
            ['setting' => 'Driver de colas', 'value' => (string) config('queue.default')],
            ['setting' => 'Vistas cacheadas', 'value' => $views ? 'si ('.count($views).')' : 'no'],
            ['setting' => 'Eventos cacheados', 'value' => $eventsCached ? 'si' : 'no'],
        ];

        if ($opcacheEnabled) {
            $used = (int) ($opcache['memory_usage']['used_memory'] ?? 0);
            $free = (int) ($opcache['memory_usage']['free_memory'] ?? 0);
            $rows[] = ['setting' => 'OPcache memoria usada', 'value' => $this->formatBytes($used).' / '.$this->formatBytes($used + $free)];
            $rows[] = ['setting' => 'OPcache hit rate', 'value' => $this->hitRate($opcache)];
        }

        $sections[] = [
            'title' => 'Configuracion de rendimiento',
            'columns' => [
                ['key' => 'setting', 'label' => 'Ajuste'],
                ['key' => 'value', 'label' => 'Valor'],
            ],
            'rows' => $rows,
            'empty' => 'Sin datos.',
        ];

        $notes[] = 'En produccion conviene config:cache, route:cache y view:cache despues de cada despliegue.';
        $notes[] = 'Si APP_DEBUG esta en true, cada error serializa el stack completo: es lo primero a corregir en produccion.';

        return [
            'key' => 'cache',
            'title' => 'Cache y build',
            'description' => 'Estado de config/route/view cache, OPcache, tamano de cache y logs.',
            'cards' => $cards,
            'sections' => $sections,
            'notes' => $notes,
        ];
    }

    protected function routeCacheFile(): string
    {
        return is_file(base_path('bootstrap/cache/routes-v7.php')) ? 'bootstrap/cache/routes-v7.php' : 'bootstrap/cache/routes.php';
    }

    protected function directorySize(string $directory): int
    {
        if (!is_dir($directory)) {
            return 0;
        }

        $bytes = 0;

        foreach (File::allFiles($directory) as $file) {
            $bytes += (int) $file->getSize();
        }

        return $bytes;
    }

    protected function hitRate(array $opcache): string
    {
        $hits = (int) ($opcache['opcache_statistics']['hits'] ?? 0);
        $misses = (int) ($opcache['opcache_statistics']['misses'] ?? 0);
        $total = $hits + $misses;

        return $total > 0 ? round($hits / $total * 100, 1).'%' : 'sin datos';
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

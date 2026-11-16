<?php

namespace Modules\Performance\Services\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Performance\Services\ImageTools;

class DatabaseReport
{
    public function __construct(protected ImageTools $images)
    {
    }

    public function build(): array
    {
        $cards = [];
        $sections = [];

        $database = DB::connection()->getDatabaseName();

        $tables = [];
        $totalBytes = 0;

        try {
            $tables = DB::select(
                'SELECT TABLE_NAME AS name, TABLE_ROWS AS rows_count, DATA_LENGTH AS data_length, INDEX_LENGTH AS index_length, DATA_FREE AS data_free
                 FROM information_schema.TABLES
                 WHERE TABLE_SCHEMA = ? AND TABLE_TYPE = "BASE TABLE"
                 ORDER BY (DATA_LENGTH + INDEX_LENGTH) DESC
                 LIMIT 15',
                [$database]
            );
        } catch (\Throwable $exception) {
            $tables = [];
        }

        foreach ($tables as $table) {
            $totalBytes += (int) $table->data_length + (int) $table->index_length;
        }

        $cards[] = [
            'label' => 'Base de datos',
            'value' => $database,
            'hint' => 'Conexion activa',
            'status' => 'ok',
        ];

        $cards[] = [
            'label' => 'Tablas mas grandes',
            'value' => $this->formatBytes($totalBytes),
            'hint' => 'Suma del top 15',
            'status' => 'ok',
        ];

        $orphans = $this->orphanImages();

        $cards[] = [
            'label' => 'Imagenes referenciadas que no existen',
            'value' => (string) $orphans['total'],
            'hint' => 'Registros apuntando a archivos borrados',
            'status' => $orphans['total'] > 0 ? 'warn' : 'ok',
        ];

        $sections[] = [
            'title' => 'Tablas mas grandes',
            'columns' => [
                ['key' => 'name', 'label' => 'Tabla'],
                ['key' => 'rows', 'label' => 'Filas'],
                ['key' => 'size', 'label' => 'Datos'],
                ['key' => 'index', 'label' => 'Indices'],
                ['key' => 'free', 'label' => 'Espacio libre'],
            ],
            'rows' => array_map(fn ($table) => [
                'name' => $table->name,
                'rows' => number_format((int) $table->rows_count),
                'size' => $this->formatBytes((int) $table->data_length),
                'index' => $this->formatBytes((int) $table->index_length),
                'free' => $this->formatBytes((int) $table->data_free),
            ], $tables),
            'empty' => 'No se pudo leer information_schema.',
        ];

        $sections[] = [
            'title' => 'Registros con imagenes inexistentes',
            'columns' => [
                ['key' => 'table', 'label' => 'Tabla.columna'],
                ['key' => 'missing', 'label' => 'Registros'],
                ['key' => 'example', 'label' => 'Ejemplo'],
            ],
            'rows' => $orphans['rows'],
            'empty' => 'Todas las imagenes referenciadas existen en disco.',
        ];

        return [
            'key' => 'database',
            'title' => 'Base de datos',
            'description' => 'Tamano de tablas, espacio libre y registros que apuntan a imagenes borradas.',
            'cards' => $cards,
            'sections' => $sections,
            'notes' => [
                'Los indices y el espacio libre se leen de information_schema; DATA_FREE alto indica tablas que conviene optimizar.',
                'Los registros con imagenes inexistentes rompen miniaturas y landings: corrigelos desde el modulo que administra esos datos.',
            ],
        ];
    }

    /**
     * Cuenta registros cuyas imagenes no existen en storage/app/public ni public/img.
     */
    protected function orphanImages(): array
    {
        $references = [
            ['aca_courses', 'image'],
            ['blog_articles', 'imagen'],
            ['cms_landings', 'main_image'],
            ['cms_testimonies', 'image'],
            ['companies', 'logo'],
            ['users', 'avatar'],
            ['onli_items', 'image'],
        ];

        $existing = $this->images->existingBasenames();
        $rows = [];
        $total = 0;

        foreach ($references as [$table, $column]) {
            if (!Schema::hasTable($table) || !Schema::hasColumn($table, $column)) {
                continue;
            }

            try {
                $values = DB::table($table)
                    ->whereNotNull($column)
                    ->where($column, '<>', '')
                    ->pluck($column);
            } catch (\Throwable $exception) {
                continue;
            }

            $missing = 0;
            $example = null;

            foreach ($values as $value) {
                $basename = strtolower(basename(str_replace('\\', '/', explode('?', (string) $value)[0])));

                if ($basename === '' || isset($existing[$basename])) {
                    continue;
                }

                $missing++;

                if ($example === null) {
                    $example = (string) $value;
                }
            }

            if ($missing > 0) {
                $total += $missing;
                $rows[] = [
                    'table' => $table.'.'.$column,
                    'missing' => (string) $missing,
                    'example' => $example,
                ];
            }
        }

        return ['total' => $total, 'rows' => $rows];
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

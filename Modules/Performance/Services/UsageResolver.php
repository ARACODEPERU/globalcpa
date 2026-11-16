<?php

namespace Modules\Performance\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class UsageResolver
{
    private ?array $databaseRefs = null;

    private ?array $templateRefs = null;

    /**
     * Usos de un archivo (por nombre de archivo) dentro de la base de datos
     * y de las plantillas / componentes del proyecto.
     */
    public function forFile(string $basename): array
    {
        $key = strtolower($basename);
        $usages = [];

        foreach ($this->databaseRefs()[$key] ?? [] as $ref) {
            $usages[] = $ref;
        }

        foreach ($this->templateRefs()[$key] ?? [] as $ref) {
            $usages[] = $ref;
        }

        return $usages;
    }

    /**
     * Columnas de la base de datos que guardan rutas de imagenes.
     */
    protected function references(): array
    {
        return [
            [
                'table' => 'blog_articles',
                'column' => 'imagen',
                'label' => 'Articulo del blog',
                'title' => 'title',
                'route' => 'blog_article_by_url',
                'route_param' => 'url',
                'route_key' => 'url',
            ],
            [
                'table' => 'cms_landings',
                'column' => 'main_image',
                'label' => 'Landing del CMS',
                'title' => 'title',
                'route' => 'web_landing',
                'route_param' => 'slug',
                'route_key' => 'slug',
            ],
            [
                'table' => 'cms_testimonies',
                'column' => 'image',
                'label' => 'Testimonios',
                'title' => 'title',
                'route' => 'web_testimonials',
            ],
            [
                'table' => 'aca_category_courses',
                'column' => 'image',
                'label' => 'Categoria de curso',
                'title' => 'description',
                'route' => 'web_courses',
            ],
            [
                'table' => 'aca_institutions',
                'column' => 'image',
                'label' => 'Institucion (carrusel de la home)',
                'title' => null,
                'route' => 'index_main',
            ],
            [
                'table' => 'aca_certificates',
                'column' => 'image',
                'label' => 'Certificado',
                'title' => 'title',
            ],
            [
                'table' => 'companies',
                'column' => 'logo',
                'label' => 'Logo de la empresa (header y footer)',
                'title' => 'business_name',
                'route' => 'index_main',
            ],
            [
                'table' => 'companies',
                'column' => 'logo_dark',
                'label' => 'Logo de la empresa (modo oscuro)',
                'title' => 'business_name',
                'route' => 'index_main',
            ],
            [
                'table' => 'companies',
                'column' => 'logo_negative',
                'label' => 'Logo negativo de la empresa',
                'title' => 'business_name',
                'route' => 'index_main',
            ],
            [
                'table' => 'companies',
                'column' => 'isotipo',
                'label' => 'Isotipo de la empresa',
                'title' => 'business_name',
                'route' => 'index_main',
            ],
            [
                'table' => 'onli_items',
                'column' => 'image',
                'label' => 'Producto de la tienda',
                'title' => 'name',
                'route' => 'onlineshop_items',
            ],
            [
                'table' => 'bib_books',
                'column' => 'cover_image',
                'label' => 'Portada de libro (biblioteca)',
                'title' => 'title',
            ],
            [
                'table' => 'banks',
                'column' => 'image',
                'label' => 'Banco (metodos de pago)',
                'title' => 'description',
                'route' => 'web_accounts',
            ],
            [
                'table' => 'billeteras_digitales',
                'column' => 'image',
                'label' => 'Billetera digital (metodos de pago)',
                'title' => 'description',
                'route' => 'web_accounts',
            ],
            [
                'table' => 'users',
                'column' => 'avatar',
                'label' => 'Avatar de usuario',
                'title' => 'name',
            ],
            [
                'table' => 'products',
                'column' => 'image',
                'label' => 'Producto',
                'title' => 'description',
            ],
            [
                'table' => 'even_events',
                'column' => 'image1',
                'label' => 'Evento',
                'title' => 'title',
            ],
        ];
    }

    /**
     * Indice nombre-de-archivo => usos en base de datos.
     */
    protected function databaseRefs(): array
    {
        if ($this->databaseRefs !== null) {
            return $this->databaseRefs;
        }

        $map = [];

        foreach ($this->references() as $reference) {
            $table = $reference['table'];
            $column = $reference['column'];

            if (!Schema::hasTable($table) || !Schema::hasColumn($table, $column)) {
                continue;
            }

            $titleColumn = $reference['title'] ?? null;
            $hasTitle = $titleColumn && Schema::hasColumn($table, $titleColumn);

            $columns = ['id', $column];

            if ($hasTitle && $titleColumn !== 'id') {
                $columns[] = $titleColumn;
            }

            if (!empty($reference['route_key']) && !in_array($reference['route_key'], $columns, true)) {
                $columns[] = $reference['route_key'];
            }

            try {
                $rows = DB::table($table)
                    ->select($columns)
                    ->whereNotNull($column)
                    ->where($column, '<>', '')
                    ->limit(5000)
                    ->get();
            } catch (\Throwable $exception) {
                continue;
            }

            foreach ($rows as $row) {
                $basename = $this->basename((string) $row->{$column});

                if ($basename === '') {
                    continue;
                }

                $map[strtolower($basename)][] = [
                    'type' => 'database',
                    'label' => $reference['label'],
                    'record' => $hasTitle ? $this->shorten((string) $row->{$titleColumn}) : '#'.$row->id,
                    'column' => $table.'.'.$column,
                    'url' => $this->routeFor($reference, $row),
                ];
            }
        }

        $map = array_merge_recursive($map, $this->courseRefs());

        return $this->databaseRefs = $map;
    }

    /**
     * Los cursos guardan la portada en aca_courses.image y se muestran en /curso/{url_slug}.
     */
    protected function courseRefs(): array
    {
        if (!Schema::hasTable('aca_courses') || !Schema::hasColumn('aca_courses', 'image')) {
            return [];
        }

        $map = [];

        try {
            $rows = DB::table('aca_courses')
                ->select(['id', 'image', 'slug'])
                ->whereNotNull('image')
                ->where('image', '<>', '')
                ->limit(5000)
                ->get();
        } catch (\Throwable $exception) {
            return [];
        }

        $landings = [];

        if (Schema::hasTable('aca_course_landings') && Schema::hasColumn('aca_course_landings', 'url_slug')) {
            try {
                $landings = DB::table('aca_course_landings')
                    ->select(['course_id', 'url_slug'])
                    ->whereNotNull('url_slug')
                    ->pluck('url_slug', 'course_id')
                    ->all();
            } catch (\Throwable $exception) {
                $landings = [];
            }
        }

        foreach ($rows as $row) {
            $basename = $this->basename((string) $row->image);

            if ($basename === '') {
                continue;
            }

            $url = null;
            $slug = $landings[$row->id] ?? null;

            if ($slug && Route::has('course_url_slug')) {
                $url = $this->toRelative(route('course_url_slug', $slug));
            } elseif (Route::has('web_course_description')) {
                $url = $this->toRelative(route('web_course_description', $row->id));
            }

            $map[strtolower($basename)][] = [
                'type' => 'database',
                'label' => 'Portada de curso',
                'record' => $this->shorten((string) $row->slug),
                'column' => 'aca_courses.image',
                'url' => $url,
            ];
        }

        return $map;
    }

    protected function routeFor(array $reference, object $row): ?string
    {
        $routeName = $reference['route'] ?? null;

        if (!$routeName || !Route::has($routeName)) {
            return null;
        }

        try {
            if (!empty($reference['route_param'])) {
                $value = $row->{$reference['route_key']} ?? null;

                if (!$value) {
                    return null;
                }

                return $this->toRelative(route($routeName, [$reference['route_param'] => $value]));
            }

            return $this->toRelative(route($routeName));
        } catch (\Throwable $exception) {
            return null;
        }
    }

    /**
     * Rutas relativas: el enlace funciona desde cualquier dominio del proyecto.
     */
    protected function toRelative(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        $base = rtrim(url('/'), '/');

        if ($base !== '' && str_starts_with($url, $base)) {
            $path = substr($url, strlen($base));

            return $path === '' ? '/' : $path;
        }

        return $url;
    }

    /**
     * Indice nombre-de-archivo => plantillas / componentes que lo referencian.
     */
    protected function templateRefs(): array
    {
        if ($this->templateRefs !== null) {
            return $this->templateRefs;
        }

        $cacheFile = storage_path('framework/cache/performance-template-refs.json');

        if (is_file($cacheFile) && (time() - (int) @filemtime($cacheFile)) < 3600) {
            $cached = json_decode((string) @file_get_contents($cacheFile), true);

            if (is_array($cached)) {
                return $this->templateRefs = $cached;
            }
        }

        $directories = [resource_path('views'), resource_path('js')];

        foreach (glob(base_path('Modules/*/Resources/assets/js'), GLOB_ONLYDIR) ?: [] as $modulePath) {
            $directories[] = $modulePath;
        }

        $map = [];
        $basePath = str_replace('\\', '/', base_path()).'/';

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                continue;
            }

            foreach (File::allFiles($directory) as $file) {
                $extension = strtolower($file->getExtension());

                if (!in_array($extension, ['php', 'vue', 'js', 'css', 'html'], true)) {
                    continue;
                }

                if ($file->getSize() > 2 * 1024 * 1024) {
                    continue;
                }

                $contents = @file_get_contents($file->getPathname());

                if ($contents === false || !preg_match_all('~[A-Za-z0-9_\-\.]+\.(?:png|jpe?g|webp|gif|svg)~i', $contents, $matches)) {
                    continue;
                }

                $relative = str_replace('\\', '/', str_replace($basePath, '', str_replace('\\', '/', $file->getPathname())));

                foreach (array_unique($matches[0]) as $token) {
                    $basename = strtolower(basename($token));

                    if ($basename === '') {
                        continue;
                    }

                    $map[$basename][$relative] = $relative;
                }
            }
        }

        $index = [];

        foreach ($map as $basename => $files) {
            foreach (array_slice(array_values($files), 0, 8) as $file) {
                $index[$basename][] = [
                    'type' => 'template',
                    'label' => 'Plantilla / componente',
                    'record' => $file,
                    'column' => null,
                    'url' => null,
                ];
            }
        }

        if (!is_dir(dirname($cacheFile))) {
            @mkdir(dirname($cacheFile), 0775, true);
        }

        @file_put_contents($cacheFile, json_encode($index));

        return $this->templateRefs = $index;
    }

    protected function basename(string $value): string
    {
        $value = trim(str_replace('\\', '/', $value));

        if ($value === '') {
            return '';
        }

        $value = explode('?', $value)[0];

        return basename($value);
    }

    protected function shorten(string $value, int $length = 60): string
    {
        $value = trim($value);

        if ($value === '') {
            return 'sin titulo';
        }

        return mb_strlen($value) > $length ? mb_substr($value, 0, $length).'...' : $value;
    }
}

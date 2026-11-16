<?php

namespace Modules\Performance\Services;

use Illuminate\Support\Facades\File;

class LazyAudit
{
    /**
     * Revisa etiquetas <img> de plantillas y componentes.
     */
    public function scan(int $limit = 400): array
    {
        $directories = [resource_path('views'), resource_path('js')];

        foreach (glob(base_path('Modules/*/Resources/assets/js'), GLOB_ONLYDIR) ?: [] as $modulePath) {
            $directories[] = $modulePath;
        }

        $basePath = str_replace('\\', '/', base_path()).'/';
        $rows = [];
        $totals = ['images' => 0, 'without_lazy' => 0, 'without_sizes' => 0, 'without_alt' => 0, 'without_decoding' => 0];

        foreach ($directories as $directory) {
            if (!is_dir($directory)) {
                continue;
            }

            foreach (File::allFiles($directory) as $file) {
                if (!in_array(strtolower($file->getExtension()), ['php', 'vue'], true)) {
                    continue;
                }

                if ($file->getSize() > 2 * 1024 * 1024) {
                    continue;
                }

                $contents = @file_get_contents($file->getPathname());

                if ($contents === false || !preg_match_all('~<img\b[^>]*>~i', $contents, $matches, PREG_OFFSET_CAPTURE)) {
                    continue;
                }

                $relative = str_replace('\\', '/', str_replace($basePath, '', str_replace('\\', '/', $file->getPathname())));

                foreach ($matches[0] as [$tag, $offset]) {
                    $totals['images']++;

                    $issues = [];
                    $lazy = preg_match('~loading\s*=\s*["\']?lazy~i', $tag) === 1;
                    $sizes = preg_match('~\bwidth\s*=~i', $tag) === 1 && preg_match('~\bheight\s*=~i', $tag) === 1;
                    $alt = preg_match('~\balt\s*=~i', $tag) === 1;
                    $decoding = preg_match('~decoding\s*=\s*["\']?async~i', $tag) === 1;

                    if (!$lazy) {
                        $totals['without_lazy']++;
                        $issues[] = 'sin loading="lazy"';
                    }

                    if (!$sizes) {
                        $totals['without_sizes']++;
                        $issues[] = 'sin width/height';
                    }

                    if (!$alt) {
                        $totals['without_alt']++;
                        $issues[] = 'sin alt';
                    }

                    if (!$decoding) {
                        $totals['without_decoding']++;
                    }

                    if ($issues === []) {
                        continue;
                    }

                    $line = substr_count(substr($contents, 0, max(0, $offset)), "\n") + 1;

                    if (count($rows) < $limit) {
                        $rows[] = [
                            'file' => $relative,
                            'line' => $line,
                            'code' => $this->shorten($tag),
                            'issues' => implode(', ', $issues),
                        ];
                    }
                }
            }
        }

        return [
            'totals' => $totals,
            'rows' => $rows,
            'truncated' => count($rows) >= $limit,
        ];
    }

    protected function shorten(string $tag, int $length = 120): string
    {
        $tag = preg_replace('~\s+~', ' ', trim($tag)) ?? $tag;

        return mb_strlen($tag) > $length ? mb_substr($tag, 0, $length).'...' : $tag;
    }
}

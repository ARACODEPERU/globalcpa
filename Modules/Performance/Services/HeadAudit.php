<?php

namespace Modules\Performance\Services;

use Illuminate\Support\Facades\File;

class HeadAudit
{
    /**
     * Revisa los bloques <head> de las vistas Blade.
     */
    public function scan(int $limit = 300): array
    {
        $rows = [];
        $totals = [
            'heads' => 0,
            'blocking' => 0,
            'inline' => 0,
            'stylesheets' => 0,
            'font_files' => 0,
            'fonts_without_preconnect' => 0,
            'without_viewport' => 0,
            'with_preload' => 0,
        ];

        foreach (File::allFiles(resource_path('views')) as $file) {
            if (strtolower($file->getExtension()) !== 'php') {
                continue;
            }

            $contents = @file_get_contents($file->getPathname());

            if ($contents === false || stripos($contents, '<head') === false) {
                continue;
            }

            $relative = str_replace('\\', '/', str_replace(str_replace('\\', '/', base_path()).'/', '', str_replace('\\', '/', $file->getPathname())));

            // Las plantillas de correo no afectan al rendimiento del sitio.
            if (str_contains($relative, 'views/emails/') || preg_match('~/email[^/]*\.blade\.php$~', $relative)) {
                continue;
            }

            preg_match_all('~<head\b.*?</head>~is', $contents, $heads, PREG_OFFSET_CAPTURE);

            foreach ($heads[0] as [$head, $offset]) {
                $totals['heads']++;
                $line = substr_count(substr($contents, 0, max(0, $offset)), "\n") + 1;

                $scripts = $this->tags($head, 'script');
                $hasPreconnect = preg_match('~rel=["\']?preconnect~i', $head) === 1;
                $hasPreload = preg_match('~rel=["\']?preload~i', $head) === 1;

                if ($hasPreload) {
                    $totals['with_preload']++;
                }

                foreach ($scripts as $script) {
                    $tag = $script['tag'];
                    $tagLine = $line + substr_count(substr($head, 0, max(0, $script['offset'])), "\n");
                    $isExternal = preg_match('~\bsrc\s*=~i', $tag) === 1;
                    $isDeferred = preg_match('~\b(defer|async|type\s*=\s*["\']?module)~i', $tag) === 1;

                    if (!$isExternal) {
                        $totals['inline']++;
                        $this->push($rows, $limit, [
                            'file' => $relative,
                            'line' => (string) $tagLine,
                            'issue' => 'Script inline en <head>',
                            'fix' => 'Muevelo al final del body o envuelvelo en DOMContentLoaded',
                            'code' => $this->shorten($tag),
                        ]);

                        continue;
                    }

                    if ($isDeferred) {
                        continue;
                    }

                    $totals['blocking']++;
                    $this->push($rows, $limit, [
                        'file' => $relative,
                        'line' => (string) $tagLine,
                        'issue' => 'Script bloqueante en <head>',
                        'fix' => 'Agrega defer (o type="module") o muevelo al final del body',
                        'code' => $this->shorten($tag),
                    ]);
                }

                $totals['stylesheets'] += count($this->tags($head, 'link', 'stylesheet'));

                $usesGoogleFonts = preg_match('~fonts\.(googleapis|gstatic)\.com~i', $head) === 1;

                if ($usesGoogleFonts) {
                    $totals['font_files']++;

                    if (!$hasPreconnect) {
                        $totals['fonts_without_preconnect']++;
                        $this->push($rows, $limit, [
                            'file' => $relative,
                            'line' => (string) $line,
                            'issue' => 'Google Fonts sin preconnect',
                            'fix' => 'Agrega <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>',
                            'code' => 'Bloque <head> con fonts.googleapis.com',
                        ]);
                    }
                }

                if (!preg_match('~name=["\']?viewport~i', $head)) {
                    $totals['without_viewport']++;
                    $this->push($rows, $limit, [
                        'file' => $relative,
                        'line' => (string) $line,
                        'issue' => 'Falta meta viewport',
                        'fix' => 'Agrega <meta name="viewport" content="width=device-width, initial-scale=1">',
                        'code' => 'Bloque <head>',
                    ]);
                }
            }
        }

        return [
            'totals' => $totals,
            'rows' => $rows,
            'truncated' => count($rows) >= $limit,
        ];
    }

    /**
     * Etiquetas de un tipo dentro de un bloque <head>.
     */
    protected function tags(string $head, string $name, ?string $mustContain = null): array
    {
        preg_match_all('~<'.$name.'\b[^>]*>~i', $head, $matches, PREG_OFFSET_CAPTURE);

        $tags = [];

        foreach ($matches[0] ?? [] as [$tag, $tagOffset]) {
            if ($mustContain !== null && stripos($tag, $mustContain) === false) {
                continue;
            }

            $tags[] = ['tag' => $tag, 'offset' => (int) $tagOffset];
        }

        return $tags;
    }

    protected function push(array &$rows, int $limit, array $row): void
    {
        if (count($rows) < $limit) {
            $rows[] = $row;
        }
    }

    protected function shorten(string $tag, int $length = 120): string
    {
        $tag = preg_replace('~\s+~', ' ', trim($tag)) ?? $tag;

        return mb_strlen($tag) > $length ? mb_substr($tag, 0, $length).'...' : $tag;
    }
}

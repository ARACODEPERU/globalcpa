<?php

namespace Modules\Performance\Services\Reports;

class PageReport
{
    /**
     * Mide paginas del propio sitio con cURL (TTFB, peso y recursos).
     */
    public function build(string $baseUrl, array $paths = ['/', '/cursos', '/complaints-book']): array
    {
        $rows = [];
        $samples = [];

        foreach ($paths as $path) {
            $url = rtrim($baseUrl, '/').$path;
            $result = $this->measure($url);

            $samples[] = $result;

            $rows[] = [
                'path' => $path,
                'status' => (string) $result['status'],
                'ttfb' => $result['ttfb_ms'].' ms',
                'total' => $result['total_ms'].' ms',
                'size' => $this->formatBytes($result['bytes']),
                'scripts' => (string) $result['scripts'],
                'styles' => (string) $result['styles'],
                'images' => (string) $result['images'],
                'blocking' => (string) $result['blocking'],
            ];
        }

        $ok = array_filter($samples, fn ($sample) => $sample['status'] === 200);
        $avgTtfb = $ok ? (int) round(array_sum(array_column($ok, 'ttfb_ms')) / count($ok)) : 0;
        $avgTotal = $ok ? (int) round(array_sum(array_column($ok, 'total_ms')) / count($ok)) : 0;
        $blocking = array_sum(array_column($samples, 'blocking'));
        $weight = array_sum(array_column($samples, 'bytes'));

        $cards = [
            [
                'label' => 'TTFB promedio',
                'value' => $avgTtfb.' ms',
                'hint' => 'Tiempo hasta el primer byte del HTML',
                'status' => $avgTtfb > 800 ? 'bad' : ($avgTtfb > 400 ? 'warn' : 'ok'),
            ],
            [
                'label' => 'Respuesta promedio',
                'value' => $avgTotal.' ms',
                'hint' => 'Descarga completa del HTML',
                'status' => $avgTotal > 2000 ? 'warn' : 'ok',
            ],
            [
                'label' => 'Scripts bloqueantes',
                'value' => (string) $blocking,
                'hint' => 'En <head> sin defer ni async',
                'status' => $blocking > 0 ? 'warn' : 'ok',
            ],
            [
                'label' => 'Peso del HTML',
                'value' => $this->formatBytes($weight),
                'hint' => 'Solo el documento, sin assets',
                'status' => $weight > 500 * 1024 ? 'warn' : 'ok',
            ],
        ];

        return [
            'key' => 'pages',
            'title' => 'Carga de paginas',
            'description' => 'Medicion interna de paginas clave: tiempo de respuesta, peso del HTML y recursos que bloquean el render.',
            'cards' => $cards,
            'sections' => [
                [
                    'title' => 'Paginas medidas',
                    'columns' => [
                        ['key' => 'path', 'label' => 'Ruta'],
                        ['key' => 'status', 'label' => 'HTTP'],
                        ['key' => 'ttfb', 'label' => 'TTFB'],
                        ['key' => 'total', 'label' => 'Total'],
                        ['key' => 'size', 'label' => 'HTML'],
                        ['key' => 'scripts', 'label' => 'Scripts'],
                        ['key' => 'styles', 'label' => 'CSS'],
                        ['key' => 'images', 'label' => 'Imagenes'],
                        ['key' => 'blocking', 'label' => 'Bloqueantes'],
                    ],
                    'rows' => $rows,
                    'empty' => 'No se pudieron medir paginas.',
                ],
            ],
            'notes' => [
                'Medicion hecha desde el servidor con cURL: mide backend + HTML, no la experiencia real del usuario.',
                'Para Core Web Vitals reales (LCP, CLS, INP) usa Lighthouse o la API de PageSpeed Insights.',
                count($ok) < count($samples) ? 'Algunas rutas no respondieron 200; revisalas antes de sacar conclusiones.' : 'Todas las rutas respondieron 200.',
            ],
        ];
    }

    protected function measure(string $url): array
    {
        $result = [
            'status' => 0,
            'ttfb_ms' => 0,
            'total_ms' => 0,
            'bytes' => 0,
            'scripts' => 0,
            'styles' => 0,
            'images' => 0,
            'blocking' => 0,
        ];

        $handle = curl_init($url);

        if ($handle === false) {
            return $result;
        }

        curl_setopt_array($handle, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 3,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_CONNECTTIMEOUT => 10,
            CURLOPT_USERAGENT => 'GlobalCPA-Performance/1.0',
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $body = curl_exec($handle);
        $info = curl_getinfo($handle);
        curl_close($handle);

        if (!is_string($body)) {
            return $result;
        }

        $result['status'] = (int) ($info['http_code'] ?? 0);
        $result['ttfb_ms'] = (int) round(((float) ($info['starttransfer_time'] ?? 0)) * 1000);
        $result['total_ms'] = (int) round(((float) ($info['total_time'] ?? 0)) * 1000);
        $result['bytes'] = strlen($body);

        $result['scripts'] = preg_match_all('~<script\b~i', $body) ?: 0;
        $result['styles'] = preg_match_all('~<link[^>]+rel=["\']?stylesheet~i', $body) ?: 0;
        $result['images'] = preg_match_all('~<img\b~i', $body) ?: 0;

        if (preg_match('~<head\b.*?</head>~is', $body, $head)) {
            preg_match_all('~<script\b[^>]*\bsrc=[^>]*>~i', $head[0], $scriptTags);

            foreach ($scriptTags[0] as $tag) {
                if (!preg_match('~\b(defer|async|type=["\']module)~i', $tag)) {
                    $result['blocking']++;
                }
            }
        }

        return $result;
    }

    protected function formatBytes(int $bytes): string
    {
        if ($bytes <= 0) {
            return '0 B';
        }

        $units = ['B', 'KB', 'MB'];
        $size = $bytes;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, $unit === 0 ? 0 : 1).' '.$units[$unit];
    }
}

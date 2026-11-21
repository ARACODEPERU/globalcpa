<?php

namespace App\Support;

/**
 * Normaliza el video del banner de un landing (enlace o HTML con iframe) para
 * que el reproductor pueda iniciarse automaticamente en silencio y aceptar
 * comandos por postMessage (reproducir / activar audio).
 */
class VideoEmbed
{
    private const ALLOW = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';

    public static function prepare(?string $value, string $title = 'Video', ?string $origin = null): string
    {
        $value = trim((string) $value);

        if ($value === '') {
            return '';
        }

        // Solo se guardo el enlace: se construye el iframe.
        if (strpos($value, '<') === false) {
            $value = '<iframe src="' . e(self::embedUrl($value)) . '" title="' . e($title)
                . '" allow="' . self::ALLOW . '" allowfullscreen></iframe>';
        }

        $prepared = preg_replace_callback('/<iframe\b[^>]*>/i', function (array $match) use ($origin, $title): string {
            $tag = $match[0];

            if (!preg_match('/\bsrc\s*=\s*"([^"]*)"/i', $tag, $src)) {
                return $tag;
            }

            $url = html_entity_decode($src[1], ENT_QUOTES);

            if (self::isYouTube($url)) {
                $url = self::withQuery($url, array_filter([
                    'autoplay' => '1',
                    'mute' => '1',
                    'playsinline' => '1',
                    'enablejsapi' => '1',
                    'origin' => $origin,
                ]));
            } elseif (self::isVimeo($url)) {
                $url = self::withQuery($url, [
                    'autoplay' => '1',
                    'muted' => '1',
                    'playsinline' => '1',
                ]);
            } else {
                return $tag;
            }

            $tag = preg_replace('/\bsrc\s*=\s*"[^"]*"/i', 'src="' . e($url) . '"', $tag, 1) ?? $tag;

            if (!preg_match('/\ballow\s*=/i', $tag)) {
                $tag = self::appendAttribute($tag, 'allow="' . self::ALLOW . '"');
            }

            if (!preg_match('/\btitle\s*=/i', $tag)) {
                $tag = self::appendAttribute($tag, 'title="' . e($title) . '"');
            }

            return $tag;
        }, $value);

        return $prepared ?? $value;
    }

    /**
     * Convierte enlaces de YouTube / Vimeo a su URL embebible.
     */
    public static function embedUrl(string $url): string
    {
        $url = trim($url);

        if (preg_match('~(?:youtube\.com/(?:watch\?(?:.*&)?v=|embed/|shorts/|live/)|youtu\.be/)([A-Za-z0-9_-]{6,})~i', $url, $match)) {
            return 'https://www.youtube.com/embed/' . $match[1];
        }

        if (preg_match('~vimeo\.com/(?:video/)?(\d+)~i', $url, $match)) {
            return 'https://player.vimeo.com/video/' . $match[1];
        }

        return $url;
    }

    private static function isYouTube(string $url): bool
    {
        return (bool) preg_match('~(?:youtube\.com|youtube-nocookie\.com)/embed/~i', $url);
    }

    private static function isVimeo(string $url): bool
    {
        return (bool) preg_match('~player\.vimeo\.com/video/~i', $url);
    }

    private static function withQuery(string $url, array $params): string
    {
        $fragment = '';

        if (($position = strpos($url, '#')) !== false) {
            $fragment = substr($url, $position);
            $url = substr($url, 0, $position);
        }

        [$base, $query] = array_pad(explode('?', $url, 2), 2, '');

        parse_str($query, $existing);

        $query = http_build_query(array_merge($existing, $params));

        return $base . ($query !== '' ? '?' . $query : '') . $fragment;
    }

    private static function appendAttribute(string $tag, string $attribute): string
    {
        if (preg_match('/\s*\/>$/', $tag)) {
            return preg_replace('/\s*\/>$/', ' ' . $attribute . ' />', $tag, 1) ?? $tag;
        }

        return preg_replace('/\s*>$/', ' ' . $attribute . '>', $tag, 1) ?? $tag;
    }
}

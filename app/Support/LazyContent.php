<?php

namespace App\Support;

/**
 * Agrega carga diferida a imagenes e iframes que vienen como HTML dinamico
 * (contenido de blog, brochures, landings, videos de testimonios, etc.).
 */
class LazyContent
{
    public static function process(?string $html, bool $eagerFirstImage = false): string
    {
        if (!is_string($html) || trim($html) === '') {
            return (string) $html;
        }

        $firstImage = true;

        $processed = preg_replace_callback('/<img\b[^>]*>/i', function (array $match) use (&$firstImage, $eagerFirstImage): string {
            $tag = $match[0];

            if ($eagerFirstImage && $firstImage) {
                $firstImage = false;
                $tag = self::withoutAttribute($tag, 'loading');

                if (!self::hasAttribute($tag, 'fetchpriority')) {
                    $tag = self::withAttribute($tag, 'fetchpriority="high"');
                }

                return $tag;
            }

            $firstImage = false;

            if (!self::hasAttribute($tag, 'loading')) {
                $tag = self::withAttribute($tag, 'loading="lazy"');
            }

            if (!self::hasAttribute($tag, 'decoding')) {
                $tag = self::withAttribute($tag, 'decoding="async"');
            }

            return $tag;
        }, $html);

        $html = $processed ?? $html;

        $processed = preg_replace_callback('/<iframe\b[^>]*>/i', function (array $match): string {
            $tag = $match[0];

            if (self::hasAttribute($tag, 'loading')) {
                return $tag;
            }

            return self::withAttribute($tag, 'loading="lazy"');
        }, $html);

        return $processed ?? $html;
    }

    private static function hasAttribute(string $tag, string $attribute): bool
    {
        return (bool) preg_match('/\s' . preg_quote($attribute, '/') . '\s*=/i', $tag);
    }

    private static function withAttribute(string $tag, string $attribute): string
    {
        if (preg_match('/\s*\/>$/', $tag)) {
            return preg_replace('/\s*\/>$/', ' ' . $attribute . ' />', $tag, 1) ?? $tag;
        }

        return preg_replace('/\s*>$/', ' ' . $attribute . '>', $tag, 1) ?? $tag;
    }

    private static function withoutAttribute(string $tag, string $attribute): string
    {
        return preg_replace(
            '/\s+' . preg_quote($attribute, '/') . '\s*=\s*("[^"]*"|\'[^\']*\'|[^\s>]+)/i',
            '',
            $tag,
            1
        ) ?? $tag;
    }
}

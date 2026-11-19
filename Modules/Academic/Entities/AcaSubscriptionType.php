<?php

namespace Modules\Academic\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academic\Database\factories\AcaSubscriptionTypeFactory;

class AcaSubscriptionType extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'usine',
        'description',
        'description_html',
        'details',
        'prices',
        'price_note',
        'price_note_below',
        'status',
        'show_dollar_price',
        'period',
        'order_number',
        'allow_all_courses',
        'allow_all_specializations',
        'allow_all_webinars',
        'allow_zoom_content',
        'allow_webinar_content'
    ];

    protected $casts = [
        'details' => 'array',
        'prices' => 'array',
        'show_dollar_price' => 'boolean',
        'allow_all_courses' => 'boolean',
        'allow_all_specializations' => 'boolean',
        'allow_all_webinars' => 'boolean',
        'allow_zoom_content' => 'boolean',
        'allow_webinar_content' => 'boolean',
    ];

    /**
     * El texto que va encima del precio se guarda como HTML acotado: solo se
     * conserva formato basico (negrita, cursiva, subrayado, tachado, color y
     * tamano) para poder pintarlo en la pagina publica sin permitir scripts ni
     * estilos arbitrarios.
     */
    public function setPriceNoteAttribute($value): void
    {
        $this->attributes['price_note'] = static::sanitizeRichText($value);
    }

    /**
     * La descripcion del plan se guarda como HTML acotado; el texto plano se
     * deriva en el controlador para el resto de pantallas.
     */
    public function setDescriptionHtmlAttribute($value): void
    {
        $this->attributes['description_html'] = static::sanitizeRichText($value);
    }

    /**
     * Mismo formato acotado que el texto de encima del precio, para el texto
     * que va debajo.
     */
    public function setPriceNoteBelowAttribute($value): void
    {
        $this->attributes['price_note_below'] = static::sanitizeRichText($value);
    }

    public static function sanitizeRichText($value): ?string
    {
        if ($value === null) {
            return null;
        }

        $html = trim((string) $value);

        if ($html === '') {
            return null;
        }

        // El editor marca los saltos de linea con <div> o <p>: se normalizan a
        // <br> para conservar el texto como un bloque simple en la pagina.
        $html = preg_replace('#<(?:div|p|h[1-6]|li|blockquote)\b[^>]*>#i', '<br>', $html);
        $html = preg_replace('#</(?:div|p|h[1-6]|li|blockquote)>#i', '', $html);
        $html = preg_replace('#^(?:\s*<br\s*/?>)+#i', '', (string) $html);
        $html = preg_replace('#(?:<br\s*/?>\s*){3,}#i', '<br><br>', (string) $html);

        $html = strip_tags(
            $html,
            '<b><strong><i><em><u><s><strike><del><br><span><small><sup><sub>'
        );

        // Se descartan todos los atributos menos el estilo de <span>, que se
        // filtra propiedad por propiedad.
        $html = preg_replace_callback('#<(/?)([a-z]+)\b([^>]*)>#i', function ($matches) {
            $closing = $matches[1] === '/';
            $tag = strtolower($matches[2]);

            if ($closing || $tag === 'br') {
                return '<' . ($closing ? '/' : '') . $tag . '>';
            }

            $style = '';

            if ($tag === 'span' && preg_match('/style\s*=\s*(?:"([^"]*)"|\'([^\']*)\')/i', $matches[3], $styleMatch)) {
                $raw = ($styleMatch[1] ?? '') !== '' ? $styleMatch[1] : ($styleMatch[2] ?? '');
                $style = static::sanitizePriceNoteStyle($raw);
            }

            return '<' . $tag . ($style !== '' ? ' style="' . e($style) . '"' : '') . '>';
        }, $html);

        $html = trim((string) $html);

        return $html === '' ? null : $html;
    }

    private static function sanitizePriceNoteStyle(string $style): string
    {
        $allowed = [];

        foreach (explode(';', $style) as $declaration) {
            if (!str_contains($declaration, ':')) {
                continue;
            }

            [$property, $value] = array_map('trim', explode(':', $declaration, 2));
            $property = strtolower($property);

            if ($value === '') {
                continue;
            }

            $valid = match ($property) {
                'color' => (bool) preg_match('/^(#[0-9a-f]{3,8}|rgba?\([0-9.,%\s]+\)|[a-z]{3,20})$/i', $value),
                'text-decoration', 'text-decoration-line' => (bool) preg_match('/^(none|underline|line-through|overline)(\s+(underline|line-through|overline))*$/i', $value),
                'font-size' => (bool) preg_match('/^[0-9]+(\.[0-9]+)?(px|rem|em|pt|%)$/', $value),
                'font-weight' => (bool) preg_match('/^(normal|bold|[1-9]00)$/', $value),
                'font-style' => in_array(strtolower($value), ['normal', 'italic'], true),
                default => false,
            };

            if ($valid) {
                $allowed[] = $property . ': ' . $value;
            }
        }

        return implode('; ', $allowed);
    }
}

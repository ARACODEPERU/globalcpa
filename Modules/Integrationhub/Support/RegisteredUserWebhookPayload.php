<?php

namespace Modules\Integrationhub\Support;

use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;

/**
 * JSON que se envía a Integrationhub cuando un usuario completa el registro
 * desde la web (por ejemplo, el registro al que invita el blog).
 *
 * Al ser el único lugar donde se define la forma del payload, cualquier cambio
 * de contrato se hace aquí y no en el controlador que lo dispara.
 */
class RegisteredUserWebhookPayload
{
    public const EVENT = 'usuario_registrado';

    /**
     * @return array<string, mixed>|null null si el usuario ya no existe.
     */
    public static function forUser(int $userId): ?array
    {
        $user = User::find($userId);

        if (! $user) {
            return null;
        }

        $country = $user->country_id ? Country::find($user->country_id) : null;
        $roles = $user->getRoleNames()->values()->all();

        return [
            'evento' => self::EVENT,
            'fecha' => Carbon::now()->toIso8601String(),
            'origen' => 'registro_web',
            'persona' => [
                'nombre' => $user->name,
                'email' => $user->email,
                'telefono' => $user->phone,
                'pais_id' => $user->country_id,
                'pais' => $country?->description,
                'fecha_registro' => $user->created_at?->toIso8601String(),
            ],
            'usuario' => [
                'id' => $user->id,
                'nombre' => $user->name,
                'email' => $user->email,
                'telefono' => $user->phone,
                'pais_id' => $user->country_id,
                'pais' => $country?->description,
                'fecha_registro' => $user->created_at?->toIso8601String(),
                'email_verificado_en' => $user->email_verified_at?->toIso8601String(),
                'roles' => $roles,
                'rol_por_defecto' => $roles[0] ?? null,
            ],
        ];
    }

    /**
     * Payload con la MISMA forma que el de una compra (ProcessCompra), para el
     * endpoint n8n_post_compra: la persona va completa en `persona` y el
     * producto es el artículo del blog identificado como `blog-{curso}`.
     *
     * @return array<string, mixed>|null null si el usuario ya no existe.
     */
    public static function forPurchaseEndpoint(int $userId, ?string $blogCurso = null): ?array
    {
        $data = self::forUser($userId);

        if (! $data) {
            return null;
        }

        $usuario = $data['usuario'];
        $partes = preg_split('/\s+/', trim((string) $usuario['nombre']), 2) ?: [];
        $curso = trim((string) $blogCurso);
        $curso = $curso !== '' ? $curso : 'registro';

        return [
            'evento' => 'registro_blog',
            'fecha' => $data['fecha'],
            'origen' => 'blog',
            'persona' => [
                'id' => $usuario['id'],
                'nombre_completo' => $usuario['nombre'],
                'nombres' => $partes[0] ?? null,
                'apellidos' => $partes[1] ?? null,
                'email' => $usuario['email'],
                'telefono' => $usuario['telefono'],
                'pais' => $usuario['pais'],
                'pais_id' => $usuario['pais_id'],
                'fecha_registro' => $usuario['fecha_registro'],
                'email_verificado_en' => $usuario['email_verificado_en'],
                'roles' => $usuario['roles'],
                'rol' => $usuario['rol_por_defecto'],
                'tipo_documento' => null,
                'numero_documento' => null,
            ],
            'venta' => [
                'id' => null,
                'total' => 0,
                'estado_pago' => 'registro',
                'metodo_pago' => null,
                'es_gratuito' => true,
                'cuotas' => 1,
                'fecha_aprobacion' => null,
                'payment_id_mp' => null,
            ],
            'productos' => [[
                // En el lugar donde una compra manda el nombre del curso,
                // el registro manda el artículo del blog: blog-{curso}.
                'nombre' => 'blog-' . $curso,
                'precio' => 0,
                'cantidad' => 1,
                'tipo' => 'blog',
                'entidad' => 'blog',
            ]],
            'factura' => null,
            'tracking' => [],
        ];
    }

    /**
     * Campos que acepta el endpoint de contactos (create_contact, ChatLevel):
     * sus mapeos solo declaran phone, email, first_name, last_name, gender,
     * tags y custom_fields. El payload completo (país, fecha, roles) se envía
     * al endpoint n8n; este es el mínimo para no perder el registro cuando ese
     * endpoint todavía no existe.
     *
     * @param  array<string, mixed>  $payload
     * @return array<string, mixed>
     */
    public static function contactFields(array $payload): array
    {
        $name = trim((string) ($payload['usuario']['nombre'] ?? ''));
        $parts = preg_split('/\s+/', $name, 2) ?: [];
        $phone = (string) ($payload['usuario']['telefono'] ?? '');

        return [
            'phone' => preg_replace('/\D+/', '', $phone) ?: $phone,
            'email' => $payload['usuario']['email'] ?? null,
            'first_name' => $parts[0] ?? null,
            'last_name' => $parts[1] ?? null,
        ];
    }
}

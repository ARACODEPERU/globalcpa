<?php

namespace Modules\Integrationhub\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Modules\Integrationhub\Entities\IntegrationEndpoint;
use Modules\Integrationhub\Http\Controllers\IntegrationhubController;
use Modules\Integrationhub\Support\IntegrationAlert;
use Modules\Integrationhub\Support\RegisteredUserWebhookPayload;

/**
 * Envía a Integrationhub los datos de un usuario recién registrado.
 *
 * Estrategia de entrega:
 *
 *   1. Endpoint principal (`registration_endpoint`, por defecto
 *      `n8n_post_compra`): recibe el payload con la misma forma que una compra
 *      (`persona`, `venta`, `productos`). La persona va completa, incluido el
 *      teléfono capturado en el registro, y el producto se identifica como
 *      `blog-{curso}` para que n8n distinga el origen.
 *   2. Si ese endpoint no existe o responde error, se cae al endpoint de
 *      contactos (`registration_fallback_endpoint`, por defecto
 *      `create_contact`), que crea el contacto con
 *      phone/email/first_name/last_name.
 *
 * Corre en cola: el submit del registro no espera a un HTTP externo y, si el
 * servicio está caído, la cola reintenta y el fallo queda en
 * integration_errors.
 */
class SendRegisteredUserToIntegrationhub implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /** Reintentos antes de pasar por failed(). */
    public $tries = 3;

    /** Mayor que el timeout HTTP de la integración (default 30s). */
    public $timeout = 120;

    /**
     * @param string|null $blogCurso Título del artículo desde el que se registró;
     *                              viaja como parte del producto `blog-{curso}`.
     */
    public function __construct(public int $userId, public ?string $blogCurso = null)
    {
    }

    public function backoff(): array
    {
        return [10, 60, 300];
    }

    public function handle(): void
    {
        $payload = RegisteredUserWebhookPayload::forPurchaseEndpoint($this->userId, $this->blogCurso);
        $contactPayload = RegisteredUserWebhookPayload::forUser($this->userId);

        // El usuario pudo eliminarse entre el encolado y la ejecución.
        if (! $payload || ! $contactPayload) {
            return;
        }

        $hub = app(IntegrationhubController::class);
        $primary = (string) config('integrationhub.registration_endpoint', 'n8n_post_compra');
        $fallback = (string) config('integrationhub.registration_fallback_endpoint', 'create_contact');
        $errors = [];

        if ($primary !== '' && $this->endpointAvailable($primary)) {
            $response = $hub->runEndpoint($primary, [], ['body' => $payload], true);

            if ($response->getStatusCode() < 400) {
                return;
            }

            $errors[] = $primary . ' => HTTP ' . $response->getStatusCode();
        } else {
            $errors[] = $primary . ' => no existe en IntegrationHub';
        }

        if ($fallback !== '' && $fallback !== $primary && $this->endpointAvailable($fallback)) {
            $response = $hub->runEndpoint(
                $fallback,
                RegisteredUserWebhookPayload::contactFields($contactPayload),
                [],
                true
            );

            if ($response->getStatusCode() < 400) {
                Log::warning('Registro enviado con el endpoint de contacto porque el endpoint principal no está disponible.', [
                    'user_id' => $this->userId,
                    'primary_endpoint' => $primary,
                    'fallback_endpoint' => $fallback,
                    'motivo' => implode(' | ', $errors),
                ]);

                return;
            }

            $errors[] = $fallback . ' => HTTP ' . $response->getStatusCode();
        }

        throw new \RuntimeException(
            'No se pudo enviar el registro a IntegrationHub: ' . implode(' | ', $errors)
        );
    }

    /**
     * El endpoint debe existir y ser único: `runEndpoint` rechaza nombres
     * duplicados (no sabría cuál integración usar).
     */
    private function endpointAvailable(string $name): bool
    {
        return IntegrationEndpoint::where('name', $name)->count() === 1;
    }

    /**
     * Se ejecuta cuando se agotan los reintentos: deja constancia en la
     * bitácora de errores del módulo.
     */
    public function failed(\Throwable $exception): void
    {
        IntegrationAlert::notify(
            'SendRegisteredUserToIntegrationhub (user_id=' . $this->userId . '): ' . $exception->getMessage(),
            'SendRegisteredUserToIntegrationhub'
        );
    }
}

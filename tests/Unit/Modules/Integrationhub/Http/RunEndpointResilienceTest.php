<?php

namespace Tests\Unit\Modules\Integrationhub\Http;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Integrationhub\Entities\IntegrationError;
use Modules\Integrationhub\Http\Controllers\IntegrationhubController;
use Modules\Integrationhub\Support\IntegrationAlert;
use Tests\TestCase;

/**
 * `IntegrationhubController::runEndpoint()` es la puerta que usa el codigo de la
 * aplicacion (jobs de compra, campanas de WhatsApp, perfil del alumno, n8n).
 * Estas pruebas fijan su contrato: si el endpoint falla, el que llamo NO se
 * interrumpe y el fallo queda en las alertas del panel.
 *
 * No toca MySQL: crea las tablas minimas sobre el sqlite en memoria de phpunit.
 */
class RunEndpointResilienceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
        ]);
        DB::purge('sqlite');

        Schema::create('integration_errors', function (Blueprint $table) {
            $table->id();
            $table->text('message');
            $table->string('source', 150)->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function test_un_endpoint_inexistente_no_interrumpe_al_que_llama_y_queda_en_las_alertas(): void
    {
        Schema::create('integration_endpoints', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('integration_id')->nullable();
            $table->string('name');
        });

        $response = app(IntegrationhubController::class)
            ->runEndpoint('create_contact', ['phone' => '51999888777']);

        $this->assertSame(404, $response->getStatusCode(), 'Debe responder el error, no lanzarlo.');

        $alerta = IntegrationError::first();

        $this->assertNotNull($alerta, 'El fallo del endpoint debe quedar en las alertas.');
        $this->assertSame(1, IntegrationError::count(), 'Una sola alerta por ejecucion fallida.');
        $this->assertStringContainsString('create_contact', $alerta->message);
        $this->assertSame(IntegrationAlert::SOURCE_ENDPOINT, $alerta->source);
    }

    public function test_un_fallo_inesperado_devuelve_error_y_alerta_en_vez_de_lanzar(): void
    {
        // A proposito no se crea `integration_endpoints`: la consulta revienta
        // antes de cualquier HTTP. La promesa es que el flujo que llamo siga.
        $response = app(IntegrationhubController::class)->runEndpoint('create_contact');

        $this->assertSame(500, $response->getStatusCode());
        $this->assertSame(1, IntegrationError::count());

        $alerta = IntegrationError::first();

        $this->assertStringContainsString('create_contact', $alerta->message);
        $this->assertSame(IntegrationAlert::SOURCE_ENDPOINT, $alerta->source);
    }
}

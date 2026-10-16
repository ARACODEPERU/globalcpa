<?php

namespace Tests\Unit\Modules\Integrationhub\Support;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Modules\Integrationhub\Entities\IntegrationError;
use Modules\Integrationhub\Support\IntegrationAlert;
use Tests\TestCase;

/**
 * La alerta de integracion (tabla `integration_errors`, pestana "Errores de
 * Integracion") se escribe justo cuando algo ya fallo, asi que no puede a su vez
 * romper el proceso que la registra: nunca lanza y, si no se puede guardar, el
 * fallo queda en los logs.
 *
 * No toca MySQL: crea las tablas minimas sobre el sqlite en memoria de phpunit.
 */
class IntegrationAlertTest extends TestCase
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

    public function test_la_alerta_queda_registrada_con_su_origen(): void
    {
        IntegrationAlert::notify('El endpoint "create_contact" respondio HTTP 500.', 'integrationhub_test');

        $error = IntegrationError::first();

        $this->assertNotNull($error, 'La alerta debe quedar registrada.');
        $this->assertSame('El endpoint "create_contact" respondio HTTP 500.', $error->message);
        $this->assertSame('integrationhub_test', $error->source);
    }

    public function test_un_origen_mas_largo_que_la_columna_no_rompe_la_alerta(): void
    {
        // La columna source es varchar(150): un origen mas largo no debe lanzar
        // (sin recorte, el insert fallaria y con el, la alerta).
        IntegrationAlert::notify('mensaje', str_repeat('x', 400));

        $error = IntegrationError::first();

        $this->assertNotNull($error);
        $this->assertSame(150, mb_strlen((string) $error->source));
    }

    public function test_si_la_alerta_falla_no_detiene_el_sistema_y_queda_en_los_logs(): void
    {
        // Sin la tabla, el insert de la alerta revienta: debe quedar en los logs
        // y el flujo continuar.
        Schema::drop('integration_errors');

        Log::shouldReceive('error')->once();

        $reachedNextStep = false;

        IntegrationAlert::notify('mensaje que no se puede guardar', 'integrationhub_test');
        $reachedNextStep = true;

        $this->assertTrue($reachedNextStep, 'La alerta no debe propagar la excepcion del insert.');
    }
}

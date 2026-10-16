<?php

namespace Tests\Unit\Modules\Integrationhub\Console;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Integrationhub\Entities\IntegrationError;
use Modules\Integrationhub\Jobs\RunIntegrationSchedule;
use Tests\TestCase;

/**
 * El comando `integrationhub:run-scheduled` corre cada minuto y encola las
 * programaciones vencidas. Una programación rota (por ejemplo con una expresión
 * cron inválida) no puede frenar a las demás: el tick termina, la fila rota se
 * apaga con su motivo y el fallo queda en las alertas del panel.
 *
 * No toca MySQL: crea las tablas minimas sobre el sqlite en memoria de phpunit.
 */
class RunScheduledIntegrationsTest extends TestCase
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

        Schema::create('integration_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('integration_id')->nullable();
            $table->string('target_type')->nullable();
            $table->unsignedBigInteger('endpoint_id')->nullable();
            $table->string('api_route_name')->nullable();
            $table->string('cron_expression', 100)->nullable();
            $table->text('payload')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_executed_at')->nullable();
            $table->timestamp('next_execution_at')->nullable();
            $table->string('last_status')->nullable();
            $table->text('last_error')->nullable();
            $table->timestamps();
        });
    }

    public function test_una_programacion_rota_no_frena_el_tick_y_queda_en_las_alertas(): void
    {
        Bus::fake();

        // Primero la rota: si el comando no la aisla, el tick muere aqui y la
        // segunda nunca se encola.
        DB::table('integration_schedules')->insert([
            'id' => 1,
            'cron_expression' => 'no es un cron',
            'is_active' => true,
            'last_status' => null,
        ]);
        DB::table('integration_schedules')->insert([
            'id' => 2,
            'cron_expression' => '* * * * *',
            'is_active' => true,
            'next_execution_at' => null,
        ]);

        $this->artisan('integrationhub:run-scheduled')->assertExitCode(0);

        $rota = DB::table('integration_schedules')->find(1);

        $this->assertFalse((bool) $rota->is_active, 'La programación rota se apaga para no repetir el error cada minuto.');
        $this->assertSame('failed', $rota->last_status);
        $this->assertStringContainsString('cron', (string) $rota->last_error);

        $alerta = IntegrationError::first();

        $this->assertNotNull($alerta, 'El fallo debe quedar en las alertas del panel.');
        $this->assertStringContainsString('Programación #1', $alerta->message);
        $this->assertSame('integrationhub_schedule_detector', $alerta->source);

        // La siguiente programación del mismo tick siguió su curso.
        Bus::assertDispatched(
            RunIntegrationSchedule::class,
            fn ($job) => $job->scheduleId === 2
        );
    }
}

<?php

namespace App\Console\Commands;

use App\Services\IntegrationhubCronExpression;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Modules\Integrationhub\Entities\IntegrationSchedule;
use Modules\Integrationhub\Jobs\RunIntegrationSchedule;
use Modules\Integrationhub\Support\IntegrationAlert;

class RunScheduledIntegrations extends Command
{
    /**
     * Clave de caché donde este comando deja su señal de vida en cada tick. La
     * pantalla de Programaciones la lee para avisar si el scheduler está caído:
     * sin señal fresca, las programaciones no se ejecutan.
     */
    public const HEARTBEAT_CACHE_KEY = 'integrationhub:run-scheduled:heartbeat';

    protected $signature = 'integrationhub:run-scheduled';

    protected $description = 'Detecta las integraciones programadas vencidas de Integrationhub y las encola.';

    public function handle(IntegrationhubCronExpression $cron): int
    {
        // Señal de vida lo antes posible: aunque una programación falle, el
        // scheduler sigue "vivo" y la pantalla no debe alarmar.
        Cache::put(
            self::HEARTBEAT_CACHE_KEY,
            now()->toIso8601String(),
            now()->addMinutes(10)
        );

        $now = now()->startOfMinute();

        $schedules = IntegrationSchedule::where('is_active', true)
            ->where(function ($query) use ($now) {
                $query->whereNull('next_execution_at')
                    ->orWhere('next_execution_at', '<=', $now);
            })
            ->get();

        foreach ($schedules as $schedule) {
            try {
                $nextExecution = $cron->nextRunDate($schedule->cron_expression, $now);

                // Programación nueva que aún no toca: solo le fijamos la próxima
                // ejecución para que el scheduler sepa cuándo volver a mirarla.
                if (is_null($schedule->next_execution_at) && ! $cron->isDue($schedule->cron_expression, $now)) {
                    $schedule->update(['next_execution_at' => $nextExecution]);
                    continue;
                }

                // Se adelanta next_execution_at al encolar para no lanzar otro job
                // para la misma programación en el siguiente tick. El trabajo pesado
                // (HTTP, reintentos, last_status/last_error) vive en el job.
                $schedule->update([
                    'next_execution_at' => $nextExecution,
                    'last_status' => 'pending',
                ]);

                RunIntegrationSchedule::dispatch($schedule->id);
            } catch (\Throwable $e) {
                // Una programación con problemas (por ejemplo una expresión cron
                // inválida) no puede frenar a las demás: sin esto, la primera
                // fila rota abortaba el tick y ninguna programación posterior se
                // encolaba nunca, en silencio.
                //
                // Se apaga sola para no repetir el error en cada tick (el
                // comando corre cada minuto), deja el motivo en su ficha y el
                // fallo queda en las alertas del panel. La alerta está protegida:
                // si no se puede guardar, se registra en los logs y el tick sigue.
                $schedule->update([
                    'is_active' => false,
                    'last_status' => 'failed',
                    'last_error' => Str::limit($e->getMessage(), 1000),
                ]);

                IntegrationAlert::notify(
                    'Programación #' . $schedule->id . ' desactivada: ' . $e->getMessage(),
                    'integrationhub_schedule_detector'
                );
            }
        }

        return self::SUCCESS;
    }
}

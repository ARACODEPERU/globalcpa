<?php

namespace App\Console\Commands;

use App\Services\IntegrationhubCronExpression;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Modules\Integrationhub\Entities\IntegrationSchedule;
use Modules\Integrationhub\Jobs\RunIntegrationSchedule;

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
        }

        return self::SUCCESS;
    }
}

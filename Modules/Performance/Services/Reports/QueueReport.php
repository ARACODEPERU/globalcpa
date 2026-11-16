<?php

namespace Modules\Performance\Services\Reports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QueueReport
{
    public function build(): array
    {
        $cards = [];
        $sections = [];
        $notes = [];

        $pending = 0;
        $byQueue = [];
        $oldest = null;

        if (Schema::hasTable('jobs')) {
            try {
                $pending = (int) DB::table('jobs')->count();
                $byQueue = DB::table('jobs')
                    ->select('queue', DB::raw('COUNT(*) as total'))
                    ->groupBy('queue')
                    ->get()
                    ->map(fn ($row) => ['queue' => $row->queue, 'total' => (string) $row->total])
                    ->all();

                $oldestTimestamp = DB::table('jobs')->min('available_at');

                if ($oldestTimestamp) {
                    $oldest = date('Y-m-d H:i', (int) $oldestTimestamp);
                }
            } catch (\Throwable $exception) {
                $pending = 0;
            }
        }

        $failed = 0;
        $failedRows = [];

        if (Schema::hasTable('failed_jobs')) {
            try {
                $failed = (int) DB::table('failed_jobs')->count();

                $failedRows = DB::table('failed_jobs')
                    ->orderByDesc('failed_at')
                    ->limit(10)
                    ->get()
                    ->map(function ($row) {
                        $payload = json_decode((string) $row->payload, true) ?: [];
                        $job = $payload['displayName'] ?? ($payload['job'] ?? 'desconocido');
                        $exception = preg_replace('~\s+~', ' ', (string) $row->exception) ?? '';

                        return [
                            'job' => class_basename((string) $job),
                            'queue' => (string) ($row->queue ?? 'default'),
                            'failed_at' => (string) $row->failed_at,
                            'error' => mb_substr($exception, 0, 140),
                        ];
                    })
                    ->all();
            } catch (\Throwable $exception) {
                $failed = 0;
            }
        }

        $cards[] = [
            'label' => 'Jobs pendientes',
            'value' => (string) $pending,
            'hint' => $oldest ? 'El mas antiguo: '.$oldest : 'Sin jobs en cola',
            'status' => $pending > 500 ? 'bad' : ($pending > 50 ? 'warn' : 'ok'),
        ];

        $cards[] = [
            'label' => 'Jobs fallidos',
            'value' => (string) $failed,
            'hint' => 'tabla failed_jobs',
            'status' => $failed > 0 ? 'warn' : 'ok',
        ];

        $cards[] = [
            'label' => 'Driver de colas',
            'value' => (string) config('queue.default'),
            'hint' => 'queue.default',
            'status' => config('queue.default') === 'sync' ? 'warn' : 'ok',
        ];

        $sections[] = [
            'title' => 'Jobs por cola',
            'columns' => [
                ['key' => 'queue', 'label' => 'Cola'],
                ['key' => 'total', 'label' => 'Pendientes'],
            ],
            'rows' => $byQueue,
            'empty' => 'No hay jobs pendientes.',
        ];

        $sections[] = [
            'title' => 'Ultimos jobs fallidos',
            'columns' => [
                ['key' => 'job', 'label' => 'Job'],
                ['key' => 'queue', 'label' => 'Cola'],
                ['key' => 'failed_at', 'label' => 'Fecha'],
                ['key' => 'error', 'label' => 'Error'],
            ],
            'rows' => $failedRows,
            'empty' => 'Sin jobs fallidos.',
        ];

        $notes[] = 'Si el driver es sync, los correos y procesos pesados se ejecutan dentro del request y hacen lenta la respuesta.';
        $notes[] = 'Los jobs fallidos deben reintentarse o eliminarse con php artisan queue:failed y queue:retry.';

        return [
            'key' => 'queues',
            'title' => 'Colas y errores',
            'description' => 'Jobs pendientes por cola, fallidos recientes y configuracion del worker.',
            'cards' => $cards,
            'sections' => $sections,
            'notes' => $notes,
        ];
    }
}

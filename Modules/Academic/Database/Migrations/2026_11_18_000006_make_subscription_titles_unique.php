<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Los tipos de suscripcion deben tener titulos distintos.
     *
     * Los duplicados existentes se diferencian con su periodo (por ejemplo
     * "FORMACIÓN EJECUTIVA (Anual)" y "FORMACIÓN EJECUTIVA (Mensual)") y, si
     * aun asi coincidieran, con el id del plan. La migracion es idempotente:
     * al ejecutarse de nuevo ya no encuentra duplicados ni vuelve a crear el
     * indice.
     */
    public function up(): void
    {
        if (! Schema::hasTable('aca_subscription_types')) {
            return;
        }

        $rows = DB::table('aca_subscription_types')
            ->orderBy('id')
            ->get(['id', 'title', 'period']);

        // Cuantas veces aparece cada titulo (sin distinguir mayusculas).
        $counts = [];

        foreach ($rows as $row) {
            $key = mb_strtolower(trim((string) $row->title));
            $counts[$key] = ($counts[$key] ?? 0) + 1;
        }

        $seen = [];

        foreach ($rows as $row) {
            $title = trim((string) $row->title);

            if ($title === '') {
                $title = 'Plan ' . $row->id;
            }

            $key = mb_strtolower($title);
            $period = trim((string) $row->period);
            $hasPeriod = $period !== '' && str_contains($key, mb_strtolower($period));

            // Si el titulo se repite, se desambigua con el periodo.
            if (($counts[$key] ?? 0) > 1 && $period !== '' && ! $hasPeriod) {
                $title .= ' (' . $period . ')';
            }

            $candidate = $title;
            $attempt = 1;

            while (isset($seen[mb_strtolower($candidate)])) {
                $candidate = $title . ' #' . $row->id . ($attempt > 1 ? '-' . $attempt : '');
                $attempt++;
            }

            $seen[mb_strtolower($candidate)] = $row->id;

            if ($candidate !== (string) $row->title) {
                DB::table('aca_subscription_types')
                    ->where('id', $row->id)
                    ->update([
                        'title' => $candidate,
                        'updated_at' => now(),
                    ]);
            }
        }

        $this->addUniqueIndex();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('aca_subscription_types')) {
            return;
        }

        $indexExists = DB::select(
            "SHOW INDEX FROM aca_subscription_types WHERE Key_name = 'aca_subscription_types_title_unique'"
        );

        if (count($indexExists) > 0) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropUnique('aca_subscription_types_title_unique');
            });
        }
    }

    private function addUniqueIndex(): void
    {
        $indexExists = DB::select(
            "SHOW INDEX FROM aca_subscription_types WHERE Key_name = 'aca_subscription_types_title_unique'"
        );

        if (count($indexExists) > 0) {
            return;
        }

        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->unique('title', 'aca_subscription_types_title_unique');
        });
    }
};

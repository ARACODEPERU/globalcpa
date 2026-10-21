<?php

use App\Models\Parameter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Registra IA-00005: tiempo maximo (segundos) que el sistema espera la
     * respuesta del agente de OpenAI antes de contestar con el modelo por
     * defecto. El agente suele tardar ~5 minutos, por eso el valor inicial es
     * 360 (6 minutos).
     *
     * No sobrescribe el valor si el parametro ya existe.
     */
    public function up(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $parameter = Parameter::firstOrNew(['parameter_code' => 'IA-00005']);

        if ($parameter->exists) {
            return;
        }

        $parameter->fill([
            'description' => 'Tiempo maximo de espera de la respuesta del agente de OpenAI, en segundos (360 = 6 minutos)',
            'control_type' => 'tx',
            'json_query_data' => null,
            'value_default' => '360',
        ]);
        $parameter->save();
    }

    public function down(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        Parameter::where('parameter_code', 'IA-00005')->delete();
    }
};

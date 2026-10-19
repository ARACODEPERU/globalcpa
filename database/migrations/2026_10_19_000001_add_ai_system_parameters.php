<?php

use App\Models\Parameter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea los parametros privados de proveedores de IA sin sobrescribir
     * valores existentes ni modificar P000025, reservado al modo de descuento.
     */
    public function up(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $parameters = [
            [
                'parameter_code' => 'IA-00001',
                'description' => 'Proveedor de inteligencia artificial para consultas del chat academico (1=OpenAI, 2=Gemini)',
                'value_default' => '1',
            ],
            [
                'parameter_code' => 'IA-00002',
                'description' => 'ID del agente creado en OpenAI para el chat academico (empieza con agent_)',
                'value_default' => env('OPENAI_AGENT_ID') ?: null,
            ],
            [
                'parameter_code' => 'IA-00003',
                'description' => 'API Key de OpenAI para la Agents API',
                'value_default' => env('API_KEY_IA', env('OPENAI_API_KEY')) ?: null,
            ],
            [
                'parameter_code' => 'IA-00004',
                'description' => 'API Key de Gemini para consultas del chat academico',
                'value_default' => env('API_KEY_GEMINI') ?: null,
            ],
        ];

        foreach ($parameters as $data) {
            $parameter = Parameter::firstOrNew(['parameter_code' => $data['parameter_code']]);

            if (! $parameter->exists) {
                $parameter->fill([
                    'description' => $data['description'],
                    'control_type' => 'tx',
                    'json_query_data' => null,
                    'value_default' => $data['value_default'],
                ]);
                $parameter->save();
            }
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        Parameter::whereIn('parameter_code', ['IA-00001', 'IA-00002', 'IA-00003', 'IA-00004'])->delete();
    }
};

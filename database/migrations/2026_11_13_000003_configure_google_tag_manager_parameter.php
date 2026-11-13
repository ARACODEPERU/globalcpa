<?php

use App\Models\Parameter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const DESCRIPTION = 'Google Tag Manager: pegue el codigo completo (script del head y noscript del body). Si esta vacio o no contiene GTM-XXXXXXX, no se inserta nada.';

    private const PREVIOUS_DESCRIPTION = 'Scripts para colocar en el header de las páginas';

    public function up(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $parameter = Parameter::where('parameter_code', 'P000022')->first();

        if (! $parameter) {
            Parameter::create([
                'parameter_code'  => 'P000022',
                'description'     => self::DESCRIPTION,
                'control_type'    => 'tx',
                'json_query_data' => null,
                'value_default'   => null,
            ]);

            return;
        }

        $parameter->update(['description' => self::DESCRIPTION]);
    }

    public function down(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        Parameter::where('parameter_code', 'P000022')
            ->update(['description' => self::PREVIOUS_DESCRIPTION]);
    }
};

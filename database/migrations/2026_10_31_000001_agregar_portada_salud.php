<?php

use App\Models\Parameter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Parámetro que guarda la portada elegida («Pagina web principal»).
     */
    private const PARAMETRO = 'PW00001';

    /**
     * Portada que se publica cuando no hay elección válida.
     */
    private const POR_DEFECTO = '1';

    /**
     * Catálogo que publica esta migración: las portadas 1 a 6.
     */
    private const CATALOGO_NUEVO = '[{"value":"1","label":"Aracode Principal"},{"value":"2","label":"Aracode torneos"},{"value":"3","label":"KAPTA LMS"},{"value":"4","label":"KIRAFACT"},{"value":"5","label":"Pichanguero"},{"value":"6","label":"SALUD"}]';

    /**
     * Catálogo anterior a esta migración: las portadas 1 a 5. Es lo que se
     * restaura al revertir.
     */
    private const CATALOGO_ANTERIOR = '[{"value":"1","label":"Aracode Principal"},{"value":"2","label":"Aracode torneos"},{"value":"3","label":"KAPTA LMS"},{"value":"4","label":"KIRAFACT"},{"value":"5","label":"Pichanguero"}]';

    /**
     * Publica la portada «SALUD» en el parámetro PW00001
     * (Parámetros → «Pagina web principal»).
     *
     * El catálogo se escribe aquí de forma explícita para que la migración no
     * dependa de código de la aplicación, y ahora incluye la portada del módulo
     * Salud (valor 6). No cambia la portada publicada: quien
     * tenía elegida otra la conserva y SALUD aparece como una opción más para
     * seleccionarla desde Parámetros.
     *
     * Idempotente: se puede volver a ejecutar sin cambiar nada.
     */
    public function up(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $parameter = Parameter::where('parameter_code', self::PARAMETRO)->first();

        if (! $parameter) {
            Parameter::create([
                'parameter_code' => self::PARAMETRO,
                'description' => 'Pagina web principal',
                'control_type' => 'sa',
                'json_query_data' => self::CATALOGO_NUEVO,
                'value_default' => self::POR_DEFECTO,
            ]);

            return;
        }

        $parameter->update(['json_query_data' => self::CATALOGO_NUEVO]);
    }

    /**
     * Deja el parámetro con el catálogo anterior (las portadas 1 a 5). El valor
     * elegido no se toca: revertir no cambia lo publicado.
     */
    public function down(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        Parameter::where('parameter_code', self::PARAMETRO)
            ->update(['json_query_data' => self::CATALOGO_ANTERIOR]);
    }
};

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
     * Catálogo completo con el que se crea el parámetro cuando no existe.
     */
    private const CATALOGO_NUEVO = '[{"value":"1","label":"Aracode Principal"},{"value":"2","label":"Aracode torneos"},{"value":"3","label":"KAPTA LMS"},{"value":"4","label":"KIRAFACT"},{"value":"5","label":"Pichanguero"},{"value":"6","label":"SALUD"}]';

    /**
     * Opción que esta migración garantiza en el desplegable.
     *
     * Se escribe aquí de forma explícita a propósito: si la migración anterior
     * escribió las opciones 1 a 5 y «SALUD» quedó fuera de la base de datos,
     * esta migración repara ese caso sin depender de código de la aplicación.
     */
    private const OPCION = ['value' => '6', 'label' => 'SALUD'];

    /**
     * Agrega la opción SALUD al parámetro PW00001 («Pagina web principal») si
     * todavía no está en la lista guardada.
     *
     * No toca las opciones que ya existan ni la portada elegida: solo publica
     * la opción que falta. Idempotente.
     */
    public function up(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $parameter = Parameter::where('parameter_code', self::PARAMETRO)->first();

        if (! $parameter) {
            // No hay parámetro: se crea con el catálogo completo, igual que la
            // migración anterior cuando la instalación es nueva.
            Parameter::create([
                'parameter_code' => self::PARAMETRO,
                'description' => 'Pagina web principal',
                'control_type' => 'sa',
                'json_query_data' => self::CATALOGO_NUEVO,
                'value_default' => self::POR_DEFECTO,
            ]);

            return;
        }

        $opciones = json_decode((string) $parameter->json_query_data, true);

        if (! is_array($opciones)) {
            $opciones = [];
        }

        $valores = array_map(
            static fn ($opcion) => is_array($opcion) ? (string) ($opcion['value'] ?? '') : '',
            $opciones
        );

        // Ya está publicada: no se escribe nada para no tocar el registro.
        if (in_array(self::OPCION['value'], $valores, true)) {
            return;
        }

        // Quita entradas vacías que haya dejado un JSON incompleto y agrega la
        // opción al final, después de las que ya conocía el desplegable.
        $opciones = array_values(array_filter($opciones, static fn ($opcion) => is_array($opcion)));
        $opciones[] = self::OPCION;

        $parameter->update([
            'json_query_data' => json_encode($opciones, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '[]',
        ]);
    }

    /**
     * Retira la opción SALUD del desplegable. El valor elegido no se toca.
     */
    public function down(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $parameter = Parameter::where('parameter_code', self::PARAMETRO)->first();

        if (! $parameter) {
            return;
        }

        $opciones = json_decode((string) $parameter->json_query_data, true);

        if (! is_array($opciones)) {
            return;
        }

        $opciones = array_values(array_filter(
            $opciones,
            static fn ($opcion) => is_array($opcion)
                && (string) ($opcion['value'] ?? '') !== self::OPCION['value']
        ));

        $parameter->update([
            'json_query_data' => json_encode($opciones, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?: '[]',
        ]);
    }
};

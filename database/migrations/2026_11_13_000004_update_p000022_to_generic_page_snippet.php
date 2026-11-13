<?php

use App\Models\Parameter;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const DESCRIPTION = 'Codigo HTML/scripts para insertar en las paginas (Blade y Vue). Todo va al head; use <!-- BODY --> para separar lo que debe ir despues de <body>. Los bloques <noscript> y el HTML de cuerpo se envian al body automaticamente. Acepta el snippet completo de Google Tag Manager.';

    public function up(): void
    {
        if (! Schema::hasTable('parameters')) {
            return;
        }

        $this->expandTextColumns();

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

        $value = (string) $parameter->value_default;

        // El valor sembrado cargaba el mismo GA4 que ya esta hardcodeado en la
        // web publica. Al habilitar la impresion generica se duplicaria, por eso
        // se respalda y se deja el parametro listo para el codigo nuevo.
        if (! preg_match('/GTM-[A-Z0-9]+/i', $value) && str_contains($value, 'G-WXX1QVD5Y0')) {
            $backup = storage_path('app/p000022-legacy.html');

            if (! File::exists($backup)) {
                File::put($backup, $value);
            }

            $parameter->value_default = null;
        }

        $parameter->description = self::DESCRIPTION;
        $parameter->save();
    }

    /**
     * Amplia las columnas para que acepten HTML/scripts largos. Es idempotente:
     * volver a aplicar el mismo tipo no cambia nada. En sqlite TEXT ya no tiene
     * el limite practico de varchar(255), por eso solo se altera MySQL.
     */
    private function expandTextColumns(): void
    {
        if (! Schema::hasColumn('parameters', 'description')
            || ! Schema::hasColumn('parameters', 'value_default')
            || DB::getDriverName() !== 'mysql') {
            return;
        }

        DB::statement('ALTER TABLE `parameters` MODIFY `description` TEXT NOT NULL');
        DB::statement('ALTER TABLE `parameters` MODIFY `value_default` LONGTEXT NULL');
    }

    public function down(): void
    {
        // No se revierten los tipos para no truncar el contenido guardado, ni se
        // restaura el valor anterior para no reactivar etiquetas duplicadas.
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Texto libre que se muestra debajo del precio del plan en la pagina
     * publica /planes-de-suscripcion (por ejemplo condiciones, vigencia o un
     * aviso adicional). Es opcional y admite formato basico.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('aca_subscription_types', 'price_note_below')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->text('price_note_below')
                    ->nullable()
                    ->after('price_note')
                    ->comment('Texto (con formato basico) que se muestra debajo del precio del plan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('aca_subscription_types', 'price_note_below')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropColumn('price_note_below');
            });
        }
    }
};

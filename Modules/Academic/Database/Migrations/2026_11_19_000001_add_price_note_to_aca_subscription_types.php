<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Texto libre que se muestra encima del precio del plan en la pagina
     * publica /planes-de-suscripcion (por ejemplo "Antes S/ 1800" o un aviso
     * de aumento). Es opcional y admite formato basico.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('aca_subscription_types', 'price_note')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->text('price_note')
                    ->nullable()
                    ->after('prices')
                    ->comment('Texto (con formato basico) que se muestra encima del precio del plan');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('aca_subscription_types', 'price_note')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropColumn('price_note');
            });
        }
    }
};

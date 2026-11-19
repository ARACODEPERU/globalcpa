<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Cada tipo de suscripcion decide si su precio en dolares se publica en la
     * pagina de suscripciones. Por defecto queda habilitado para no cambiar el
     * comportamiento de los planes que ya tenian precio en USD.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('aca_subscription_types', 'show_dollar_price')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->boolean('show_dollar_price')
                    ->default(true)
                    ->after('status')
                    ->comment('Mostrar el precio en dolares en la pagina publica de suscripciones');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('aca_subscription_types', 'show_dollar_price')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropColumn('show_dollar_price');
            });
        }
    }
};

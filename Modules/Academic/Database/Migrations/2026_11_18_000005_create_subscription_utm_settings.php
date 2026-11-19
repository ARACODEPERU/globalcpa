<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * La campana UTM es compartida por todos los planes (un solo enlace a
     * /planes-de-suscripcion), por eso la configuracion deja de vivir en cada
     * tipo de suscripcion y pasa a una tabla unica.
     */
    public function up(): void
    {
        if (!Schema::hasTable('aca_subscription_utm_settings')) {
            Schema::create('aca_subscription_utm_settings', function (Blueprint $table) {
                $table->id();
                $table->string('campaign')->nullable();
                $table->json('channels')->nullable();
                $table->timestamps();
            });

            DB::table('aca_subscription_utm_settings')->insert([
                'campaign' => 'suscripciones',
                'channels' => json_encode([]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        if (Schema::hasColumn('aca_subscription_types', 'utm_config')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropColumn('utm_config');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (!Schema::hasColumn('aca_subscription_types', 'utm_config')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->json('utm_config')->nullable();
            });
        }

        Schema::dropIfExists('aca_subscription_utm_settings');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Configuracion UTM de cada tipo de suscripcion y eventos de atribucion
     * capturados en la pagina publica /planes-de-suscripcion.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('aca_subscription_types', 'utm_config')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->json('utm_config')->nullable()
                    ->comment('campaña y canales utm configurados para el plan');
            });
        }

        if (!Schema::hasTable('aca_subscription_tracking')) {
            Schema::create('aca_subscription_tracking', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('subscription_type_id')->nullable()->index();
                $table->string('event', 20)->default('view')->comment('view | click');
                $table->string('utm_source')->nullable();
                $table->string('utm_medium')->nullable();
                $table->string('utm_campaign')->nullable();
                $table->string('utm_term', 500)->nullable();
                $table->string('utm_content', 500)->nullable();
                $table->string('utm_id')->nullable();
                $table->string('fbclid', 500)->nullable();
                $table->string('gclid', 500)->nullable();
                $table->string('referer', 500)->nullable();
                $table->string('landing_url', 500)->nullable();
                $table->string('traffic_source', 50)->nullable()
                    ->comment('origen clasificado: social, facebook_ads, organic, email, referrer...');
                $table->string('client_ip', 45)->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aca_subscription_tracking');

        if (Schema::hasColumn('aca_subscription_types', 'utm_config')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropColumn('utm_config');
            });
        }
    }
};

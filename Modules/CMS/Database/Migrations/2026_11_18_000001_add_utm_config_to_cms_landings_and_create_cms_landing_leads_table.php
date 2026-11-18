<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasColumn('cms_landings', 'utm_config')) {
            Schema::table('cms_landings', function (Blueprint $table) {
                $table->json('utm_config')->nullable()->after('date_end')
                    ->comment('nombre de campaña y canales utm configurados para la landing');
            });
        }

        if (!Schema::hasTable('cms_landing_leads')) {
            Schema::create('cms_landing_leads', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('landing_id')->nullable()->index();
                $table->string('menu_id', 2)->nullable();
                $table->unsignedBigInteger('person_id')->nullable()->index();
                $table->string('name', 300)->nullable();
                $table->string('email')->nullable();
                $table->string('phone', 30)->nullable();
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
                $table->string('traffic_source', 50)->nullable()->comment('origen clasificado: social, facebook_ads, organic, email, referrer...');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms_landing_leads');

        if (Schema::hasColumn('cms_landings', 'utm_config')) {
            Schema::table('cms_landings', function (Blueprint $table) {
                $table->dropColumn('utm_config');
            });
        }
    }
};

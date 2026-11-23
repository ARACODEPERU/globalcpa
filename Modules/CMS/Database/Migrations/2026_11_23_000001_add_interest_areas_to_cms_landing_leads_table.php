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
        if (Schema::hasTable('cms_landing_leads') && !Schema::hasColumn('cms_landing_leads', 'interest_areas')) {
            Schema::table('cms_landing_leads', function (Blueprint $table) {
                $table->json('interest_areas')->nullable()->after('phone')
                    ->comment('areas de interes elegidas en el paso 2 de la landing de curso gratis');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('cms_landing_leads') && Schema::hasColumn('cms_landing_leads', 'interest_areas')) {
            Schema::table('cms_landing_leads', function (Blueprint $table) {
                $table->dropColumn('interest_areas');
            });
        }
    }
};

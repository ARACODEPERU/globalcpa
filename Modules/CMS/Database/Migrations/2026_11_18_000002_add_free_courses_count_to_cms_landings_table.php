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
        if (!Schema::hasColumn('cms_landings', 'free_courses_count')) {
            Schema::table('cms_landings', function (Blueprint $table) {
                $table->unsignedTinyInteger('free_courses_count')->default(1)->after('utm_config')
                    ->comment('cuantos cursos gratis puede elegir el usuario en la landing (1 a 3)');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('cms_landings', 'free_courses_count')) {
            Schema::table('cms_landings', function (Blueprint $table) {
                $table->dropColumn('free_courses_count');
            });
        }
    }
};

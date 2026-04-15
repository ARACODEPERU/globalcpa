<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aca_course_landings', function (Blueprint $table) {
            $table->json('professional_section')->nullable()->after('banner_language');
        });
    }

    public function down(): void
    {
        Schema::table('aca_course_landings', function (Blueprint $table) {
            $table->dropColumn('professional_section');
        });
    }
};

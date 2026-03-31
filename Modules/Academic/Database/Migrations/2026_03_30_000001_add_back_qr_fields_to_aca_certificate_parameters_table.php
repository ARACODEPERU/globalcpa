<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('aca_certificate_parameters', function (Blueprint $table) {
            $table->integer('back_size_qr')->nullable()->after('back_visible_module');
            $table->string('back_font_align_qr')->nullable()->after('back_size_qr');
            $table->integer('back_position_qr_x')->nullable()->after('back_font_align_qr');
            $table->integer('back_position_qr_y')->nullable()->after('back_position_qr_x');
            $table->boolean('back_visible_qr')->default(false)->after('back_position_qr_y');
        });
    }

    public function down(): void
    {
        Schema::table('aca_certificate_parameters', function (Blueprint $table) {
            $table->dropColumn([
                'back_size_qr',
                'back_font_align_qr',
                'back_position_qr_x',
                'back_position_qr_y',
                'back_visible_qr',
            ]);
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * PDF opcional que el administrador puede adjuntar a un artículo del blog.
     *
     * Idempotente: si la tabla no existe la migración no hace nada y, si la
     * columna ya fue creada (por una ejecución anterior o por otra migración),
     * tampoco intenta crearla de nuevo.
     */
    public function up(): void
    {
        if (! Schema::hasTable('blog_articles')) {
            return;
        }

        if (Schema::hasColumn('blog_articles', 'pdf_path')) {
            return;
        }

        Schema::table('blog_articles', function (Blueprint $table) {
            $table->string('pdf_path')->nullable()->after('imagen');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('blog_articles')) {
            return;
        }

        if (! Schema::hasColumn('blog_articles', 'pdf_path')) {
            return;
        }

        Schema::table('blog_articles', function (Blueprint $table) {
            $table->dropColumn('pdf_path');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * La descripcion del plan se puede escribir con formato (tamano, color,
 * negrita, etc.) en el panel. El HTML acotado vive en description_html y la
 * columna description se mantiene como texto plano para listados, comprobantes
 * y webhooks que ya la usan.
 */
return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('aca_subscription_types', 'description_html')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->text('description_html')->nullable()->after('description')
                    ->comment('Descripción con formato (HTML acotado) para la página pública de planes');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('aca_subscription_types', 'description_html')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->dropColumn('description_html');
            });
        }
    }
};

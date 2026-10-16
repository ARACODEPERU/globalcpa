<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Hasta ahora el acceso a los enlaces Zoom/Meet y al contenido tipo
     * webinar dentro de los programas de especialización estaba codificado
     * directamente ("Premium VIP" ve webinars, no ve Zoom). Estos flags
     * permiten configurarlo por cada tipo de suscripción.
     */
    public function up(): void
    {
        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->boolean('allow_specialization_zoom')
                ->default(false)
                ->after('order_number')
                ->comment('Permite ver los enlaces Zoom/Meet dentro de programas de especialización');
            $table->boolean('allow_specialization_webinar')
                ->default(false)
                ->after('allow_specialization_zoom')
                ->comment('Permite ver el contenido tipo webinar dentro de programas de especialización');
        });

        // Preserva el comportamiento previo de Premium VIP: ve webinars, pero
        // no los enlaces Zoom/Meet de los programas de especialización.
        DB::table('aca_subscription_types')
            ->where('title', 'LIKE', '%Premium VIP%')
            ->update([
                'allow_specialization_zoom' => false,
                'allow_specialization_webinar' => true,
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->dropColumn(['allow_specialization_zoom', 'allow_specialization_webinar']);
        });
    }
};

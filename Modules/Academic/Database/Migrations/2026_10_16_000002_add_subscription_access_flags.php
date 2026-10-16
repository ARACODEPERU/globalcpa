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
     * El acceso de una suscripcion deja de depender del nombre del plan
     * ("Premium VIP") y pasa a ser 100% editable con flags:
     *   - allow_all_courses:         acceso a cursos y talleres.
     *   - allow_all_specializations: acceso a programas de especializacion.
     *   - allow_all_webinars:        acceso a los cursos tipo Webinar.
     *   - allow_zoom_content:        ver contenido Meet/Zoom (is_file = 3).
     *   - allow_webinar_content:     ver contenido tipo webinar (is_file = 5).
     */
    public function up(): void
    {
        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->boolean('allow_all_courses')
                ->default(false)
                ->after('allow_specialization_webinar')
                ->comment('Acceso a todos los cursos y talleres');
            $table->boolean('allow_all_specializations')
                ->default(false)
                ->after('allow_all_courses')
                ->comment('Acceso a todos los programas de especializacion');
            $table->boolean('allow_all_webinars')
                ->default(false)
                ->after('allow_all_specializations')
                ->comment('Acceso a todos los cursos tipo Webinar');
        });

        // Los dos flags de contenido se generalizan: ya no son exclusivos de los
        // programas de especializacion, aplican a cualquier curso accesible.
        if (Schema::hasColumn('aca_subscription_types', 'allow_specialization_zoom')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->renameColumn('allow_specialization_zoom', 'allow_zoom_content');
            });
        }

        if (Schema::hasColumn('aca_subscription_types', 'allow_specialization_webinar')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->renameColumn('allow_specialization_webinar', 'allow_webinar_content');
            });
        }

        // Refleja el comportamiento que ya tenian los planes existentes: todos
        // veian cursos/talleres y webinars, y su contenido (salvo el Meet/Zoom
        // de Premium VIP). El acceso a especializacion solo lo daba Premium VIP.
        DB::table('aca_subscription_types')->update([
            'allow_all_courses' => true,
            'allow_all_webinars' => true,
            'allow_zoom_content' => true,
            'allow_webinar_content' => true,
        ]);

        DB::table('aca_subscription_types')
            ->where('title', 'LIKE', '%Premium VIP%')
            ->update([
                'allow_all_specializations' => true,
                'allow_zoom_content' => false,
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('aca_subscription_types', 'allow_zoom_content')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->renameColumn('allow_zoom_content', 'allow_specialization_zoom');
            });
        }

        if (Schema::hasColumn('aca_subscription_types', 'allow_webinar_content')) {
            Schema::table('aca_subscription_types', function (Blueprint $table) {
                $table->renameColumn('allow_webinar_content', 'allow_specialization_webinar');
            });
        }

        Schema::table('aca_subscription_types', function (Blueprint $table) {
            $table->dropColumn(['allow_all_courses', 'allow_all_specializations', 'allow_all_webinars']);
        });
    }
};

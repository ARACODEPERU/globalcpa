<?php

namespace Tests\Unit\Modules\Academic\Services;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Academic\Entities\AcaContent;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaModule;
use Modules\Academic\Entities\AcaTheme;
use Modules\Academic\Services\CourseAccessService;
use Tests\TestCase;

/**
 * El acceso a cursos, programas de especializacion y webinars ya no depende del
 * nombre del plan ("Premium VIP"): sale de los checks editables del tipo de
 * suscripcion. Estos tests fijan esa regla: renombrar un plan no cambia lo que
 * desbloquea, y cada flag manda sobre su categoria.
 *
 * No toca MySQL: crea las tablas minimas sobre el sqlite en memoria de phpunit.
 */
class CourseAccessServiceTest extends TestCase
{
    private CourseAccessService $service;

    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
        ]);
        DB::purge('sqlite');

        Schema::create('aca_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('type_description')->nullable();
            $table->decimal('price', 12, 2)->nullable();
        });

        Schema::create('aca_cap_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('course_id');
            $table->boolean('unlimited')->default(true);
            $table->date('date_end')->nullable();
        });

        Schema::create('aca_subscription_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->boolean('allow_all_courses')->default(false);
            $table->boolean('allow_all_specializations')->default(false);
            $table->boolean('allow_all_webinars')->default(false);
            $table->boolean('allow_zoom_content')->default(false);
            $table->boolean('allow_webinar_content')->default(false);
        });

        Schema::create('aca_student_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subscription_id');
            $table->boolean('status')->default(true);
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
        });

        $this->service = new CourseAccessService();
    }

    // ---------------------------------------------------------------------
    // Acceso a cursos por categoria
    // ---------------------------------------------------------------------

    public function test_el_acceso_a_especializacion_no_depende_del_nombre_del_plan(): void
    {
        $course = $this->course('Programas de Especialización', 100);

        // Un plan renombrado, con el check activado, sigue abriendo los programas.
        $renombrado = $this->subscriptionType('Plan Renombrado 2027', [
            'allow_all_specializations' => true,
        ]);
        $this->subscribe(1, $renombrado);

        $this->assertTrue(
            $this->service->canAccess(1, $course),
            'Renombrar el plan no debe quitar el acceso a programas de especializacion.'
        );
    }

    public function test_llamarse_premium_vip_sin_el_check_no_da_acceso(): void
    {
        $course = $this->course('Programas de Especialización', 100);

        // Antes bastaba con llamarse "Premium VIP"; ahora el nombre no otorga nada.
        $vip = $this->subscriptionType('Premium VIP', [
            'allow_all_specializations' => false,
        ]);
        $this->subscribe(2, $vip);

        $this->assertFalse(
            $this->service->canAccess(2, $course),
            'El nombre "Premium VIP" por si solo ya no debe habilitar el acceso.'
        );
    }

    public function test_los_cursos_taller_dependen_del_check_de_cursos(): void
    {
        $course = $this->course('Cursos Taller', 100);

        $sinCursos = $this->subscriptionType('Solo webinars', [
            'allow_all_webinars' => true,
        ]);
        $this->subscribe(3, $sinCursos);
        $this->assertFalse($this->service->canAccess(3, $course));

        $conCursos = $this->subscriptionType('Cursos', [
            'allow_all_courses' => true,
        ]);
        $this->subscribe(4, $conCursos);
        $this->assertTrue($this->service->canAccess(4, $course));
    }

    public function test_los_webinars_dependen_de_su_propio_check(): void
    {
        $webinar = $this->course('Webinar', 100);

        // Tener acceso a cursos/talleres no incluye los webinars.
        $taller = $this->subscriptionType('Taller', [
            'allow_all_courses' => true,
        ]);
        $this->subscribe(5, $taller);
        $this->assertFalse(
            $this->service->canAccess(5, $webinar),
            'El acceso a webinars es un check aparte.'
        );

        $conWebinars = $this->subscriptionType('Webinars', [
            'allow_all_webinars' => true,
        ]);
        $this->subscribe(6, $conWebinars);
        $this->assertTrue($this->service->canAccess(6, $webinar));
    }

    public function test_un_bootcamp_se_trata_como_curso(): void
    {
        $course = $this->course('Bootcamp', 100);

        $type = $this->subscriptionType('Cursos', ['allow_all_courses' => true]);
        $this->subscribe(7, $type);

        $this->assertTrue($this->service->canAccess(7, $course));
    }

    public function test_un_curso_gratis_es_accesible_sin_suscripcion(): void
    {
        $course = $this->course('Cursos Taller', 0);

        $this->assertTrue($this->service->canAccess(8, $course));
    }

    public function test_un_webinar_gratis_sin_check_no_es_accesible(): void
    {
        $course = $this->course('Webinar', 0);

        // Aunque sea gratis, el check de webinars es el que los controla.
        $this->assertFalse($this->service->canAccess(14, $course));
    }

    public function test_un_webinar_gratis_con_check_es_accesible(): void
    {
        $course = $this->course('Webinar', 0);

        $type = $this->subscriptionType('Webinars', ['allow_all_webinars' => true]);
        $this->subscribe(14, $type);

        $this->assertTrue($this->service->canAccess(14, $course));
    }

    public function test_una_especializacion_gratis_sin_check_no_es_accesible(): void
    {
        $course = $this->course('Programas de Especialización', 0);

        $this->assertFalse($this->service->canAccess(15, $course));
    }

    public function test_una_especializacion_gratis_con_check_es_accesible(): void
    {
        $course = $this->course('Programas de Especialización', 0);

        $type = $this->subscriptionType('Programas', ['allow_all_specializations' => true]);
        $this->subscribe(15, $type);

        $this->assertTrue($this->service->canAccess(15, $course));
    }

    public function test_la_matricula_vigente_abre_especializacion_sin_suscripcion(): void
    {
        $course = $this->course('Programas de Especialización', 100);

        $this->register(9, $course->id);

        $this->assertTrue($this->service->canAccess(9, $course));
    }

    public function test_una_suscripcion_inactiva_y_vencida_no_da_acceso(): void
    {
        $course = $this->course('Cursos Taller', 100);

        $type = $this->subscriptionType('Vencido', ['allow_all_courses' => true]);
        DB::table('aca_student_subscriptions')->insert([
            'student_id' => 10,
            'subscription_id' => $type,
            'status' => false,
            'date_start' => now()->subMonths(2)->toDateString(),
            'date_end' => now()->subMonth()->toDateString(),
        ]);

        $this->assertFalse($this->service->canAccess(10, $course));
    }

    public function test_una_suscripcion_vigente_por_fechas_cuenta_aunque_el_status_este_desactualizado(): void
    {
        $course = $this->course('Cursos Taller', 100);

        $type = $this->subscriptionType('Por vencer', ['allow_all_courses' => true]);
        DB::table('aca_student_subscriptions')->insert([
            'student_id' => 13,
            'subscription_id' => $type,
            'status' => false,
            'date_start' => now()->subDay()->toDateString(),
            'date_end' => now()->addMonth()->toDateString(),
        ]);

        $this->assertTrue(
            $this->service->canAccess(13, $course),
            'Mientras no venza, la suscripcion sigue dando acceso aunque el status no se haya refrescado.'
        );
    }

    public function test_los_permisos_se_suman_entre_suscripciones(): void
    {
        $especializacion = $this->course('Programas de Especialización', 100);
        $webinar = $this->course('Webinar', 100);

        // Dos planes que juntos cubren especializacion y webinars.
        $planA = $this->subscriptionType('Plan A', ['allow_all_specializations' => true]);
        $planB = $this->subscriptionType('Plan B', ['allow_all_webinars' => true]);
        $this->subscribe(11, $planA);
        $this->subscribe(11, $planB);

        $this->assertTrue($this->service->canAccess(11, $especializacion));
        $this->assertTrue($this->service->canAccess(11, $webinar));
    }

    public function test_el_acceso_a_especializacion_queda_disponible_para_el_programa(): void
    {
        $type = $this->subscriptionType('Premium VIP', [
            'allow_all_courses' => true,
            'allow_all_specializations' => true,
            'allow_all_webinars' => true,
        ]);
        $this->subscribe(12, $type);

        $flags = $this->service->accessFlags(12);

        $this->assertTrue($flags['specializations']);
        $this->assertTrue($this->service->canAccessCategory($flags, 'Programas de Especialización'));
        $this->assertTrue($this->service->canAccessCategory($flags, 'Programas de Especializacion'));
    }

    // ---------------------------------------------------------------------
    // Tipos de contenido dentro de un curso accesible
    // ---------------------------------------------------------------------

    public function test_el_contenido_meet_zoom_requiere_el_check_de_especializacion(): void
    {
        $conEspecializacionYZoom = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => true,
            'zoom' => true,
        ]);
        $conEspecializacionSinZoom = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => true,
            'zoom' => false,
        ]);
        // El check de contenido solo, sin acceso a programas de especializacion,
        // no debe mostrar nada.
        $zoomSinEspecializacion = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => false,
            'zoom' => true,
        ]);

        $this->assertTrue($this->service->canSeeContent($conEspecializacionYZoom, CourseAccessService::CONTENT_ZOOM, false, false));
        $this->assertFalse(
            $this->service->canSeeContent($conEspecializacionSinZoom, CourseAccessService::CONTENT_ZOOM, false, false),
            'Sin el check de Meet/Zoom el enlace no debe mostrarse.'
        );
        $this->assertFalse(
            $this->service->canSeeContent($zoomSinEspecializacion, CourseAccessService::CONTENT_ZOOM, false, false),
            'Sin acceso a programas de especializacion el contenido Meet/Zoom se oculta.'
        );
    }

    public function test_un_plan_sin_especializacion_no_muestra_contenido_meet_zoom_ni_webinar(): void
    {
        // Plan con todos los checks de contenido encendidos, pero sin acceso a
        // programas de especializacion: ese contenido se oculta para no ofrecer
        // permisos que no aplican.
        $type = $this->subscriptionType('Solo cursos', [
            'allow_all_courses' => true,
            'allow_all_webinars' => true,
            'allow_zoom_content' => true,
            'allow_webinar_content' => true,
        ]);
        $this->subscribe(16, $type);

        $flags = $this->service->accessFlags(16);

        $this->assertTrue($flags['courses']);
        $this->assertFalse($flags['specializations']);
        $this->assertFalse($this->service->canSeeContent($flags, CourseAccessService::CONTENT_ZOOM, false, false));
        $this->assertFalse($this->service->canSeeContent($flags, CourseAccessService::CONTENT_WEBINAR, false, false));
    }

    public function test_un_plan_con_especializacion_y_sus_checks_si_muestra_ese_contenido(): void
    {
        $type = $this->subscriptionType('Con especializacion', [
            'allow_all_specializations' => true,
            'allow_zoom_content' => true,
            'allow_webinar_content' => true,
        ]);
        $this->subscribe(17, $type);

        $flags = $this->service->accessFlags(17);

        $this->assertTrue($this->service->canSeeContent($flags, CourseAccessService::CONTENT_ZOOM, false, false));
        $this->assertTrue($this->service->canSeeContent($flags, CourseAccessService::CONTENT_WEBINAR, false, false));
    }

    public function test_la_matricula_y_los_cursos_gratis_ven_el_contenido_meet_zoom(): void
    {
        $sinFlags = CourseAccessService::emptyFlags();

        $this->assertTrue($this->service->canSeeContent($sinFlags, CourseAccessService::CONTENT_ZOOM, true, false));
        $this->assertTrue($this->service->canSeeContent($sinFlags, CourseAccessService::CONTENT_ZOOM, false, true));
    }

    public function test_el_contenido_tipo_webinar_requiere_el_check_de_especializacion(): void
    {
        $conEspecializacionYWebinar = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => true,
            'webinar_content' => true,
        ]);
        $conEspecializacionSinWebinar = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => true,
            'webinar_content' => false,
        ]);
        $webinarSinEspecializacion = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => false,
            'webinar_content' => true,
        ]);

        $this->assertTrue($this->service->canSeeContent($conEspecializacionYWebinar, CourseAccessService::CONTENT_WEBINAR, false, false));
        $this->assertFalse(
            $this->service->canSeeContent($conEspecializacionSinWebinar, CourseAccessService::CONTENT_WEBINAR, false, false),
            'El contenido tipo webinar requiere su propio check.'
        );
        $this->assertFalse(
            $this->service->canSeeContent($webinarSinEspecializacion, CourseAccessService::CONTENT_WEBINAR, false, false),
            'Sin acceso a programas de especializacion el contenido tipo webinar se oculta.'
        );
    }

    public function test_el_matriculado_sin_check_no_ve_el_contenido_webinar(): void
    {
        $sinFlags = CourseAccessService::emptyFlags();

        $this->assertFalse(
            $this->service->canSeeContent($sinFlags, CourseAccessService::CONTENT_WEBINAR, true, false),
            'La matricula da las sesiones Meet/Zoom, no el contenido tipo webinar.'
        );
    }

    public function test_los_demas_contenidos_siempre_son_visibles(): void
    {
        $sinFlags = CourseAccessService::emptyFlags();

        foreach ([0, 1, 2, 4] as $isFile) {
            $this->assertTrue(
                $this->service->canSeeContent($sinFlags, $isFile, false, false),
                "El contenido tipo {$isFile} no debe filtrarse."
            );
        }
    }

    // ---------------------------------------------------------------------
    // Listado "Mis cursos": el contenido de un curso bloqueado no viaja
    // ---------------------------------------------------------------------

    public function test_un_curso_sin_acceso_no_expone_su_contenido(): void
    {
        $course = $this->courseWithContents([['description' => 'Meet', 'is_file' => 3]]);
        $course->can_view = false;

        $this->assertArrayHasKey('modules', $course->toArray(), 'Precondicion: el curso traia su contenido.');

        $this->service->hideContentsNotAllowed(collect([$course]), CourseAccessService::emptyFlags(), 30);

        $this->assertArrayNotHasKey(
            'modules',
            $course->toArray(),
            'Un curso sin can_view no debe llevar modulos/temas/contenidos: ahi iria el enlace Meet/Zoom.'
        );
    }

    public function test_un_curso_accesible_con_permiso_conserva_su_contenido(): void
    {
        $course = $this->courseWithContents([['description' => 'Meet', 'is_file' => 3]]);
        $course->can_view = true;

        $flags = array_merge(CourseAccessService::emptyFlags(), [
            'specializations' => true,
            'zoom' => true,
        ]);

        $this->service->hideContentsNotAllowed(collect([$course]), $flags, 31);

        $this->assertArrayHasKey('modules', $course->toArray());
        $this->assertSame([3], $this->contentsIsFile($course));
    }

    public function test_un_curso_accesible_sin_permiso_no_expone_ese_contenido(): void
    {
        // Plan con acceso a cursos pero sin programas de especializacion: ni
        // Meet/Zoom ni webinar deben viajar en el payload.
        $course = $this->courseWithContents([
            ['description' => 'Meet', 'is_file' => 3],
            ['description' => 'Webinar', 'is_file' => 5],
            ['description' => 'PDF', 'is_file' => 1],
        ]);
        $course->can_view = true;

        $flags = array_merge(CourseAccessService::emptyFlags(), [
            'courses' => true,
            'zoom' => true,
            'webinar_content' => true,
        ]);

        $this->service->hideContentsNotAllowed(collect([$course]), $flags, 32);

        $this->assertSame([1], $this->contentsIsFile($course));
    }

    public function test_la_matricula_conserva_meet_zoom_pero_no_el_webinar(): void
    {
        $course = $this->courseWithContents([
            ['description' => 'Meet', 'is_file' => 3],
            ['description' => 'Webinar', 'is_file' => 5],
        ], id: 40);
        $course->can_view = true;

        DB::table('aca_cap_registrations')->insert([
            'student_id' => 33,
            'course_id' => 40,
            'unlimited' => true,
        ]);

        $this->service->hideContentsNotAllowed(collect([$course]), CourseAccessService::emptyFlags(), 33);

        $this->assertSame(
            [3],
            $this->contentsIsFile($course),
            'La matricula habilita Meet/Zoom, pero el webinar sigue dependiendo del plan.'
        );
    }

    // ---------------------------------------------------------------------
    // Helpers
    // ---------------------------------------------------------------------

    /**
     * @param array<int, array<string, mixed>> $contents
     */
    private function courseWithContents(array $contents, int $id = 1): AcaCourse
    {
        $course = new AcaCourse(['description' => 'Curso con contenido', 'price' => 100]);
        $course->id = $id;

        $theme = new AcaTheme(['description' => 'Tema 1']);
        $theme->setRelation('contents', collect($contents)->map(fn ($attributes) => new AcaContent($attributes))->values());

        $module = new AcaModule(['description' => 'Modulo 1']);
        $module->setRelation('themes', collect([$theme]));

        $course->setRelation('modules', collect([$module]));

        return $course;
    }

    /**
     * Tipos de contenido (is_file) que quedan visibles en el curso.
     *
     * @return int[]
     */
    private function contentsIsFile(AcaCourse $course): array
    {
        return $course->modules
            ->flatMap(fn ($module) => $module->themes)
            ->flatMap(fn ($theme) => $theme->contents)
            ->map(fn ($content) => (int) $content->is_file)
            ->values()
            ->all();
    }

    private function course(?string $typeDescription, $price): AcaCourse
    {
        $id = DB::table('aca_courses')->insertGetId([
            'description' => 'Curso de prueba ' . $typeDescription,
            'type_description' => $typeDescription,
            'price' => $price,
        ]);

        return AcaCourse::find($id);
    }

    private function subscriptionType(string $title, array $flags): int
    {
        return DB::table('aca_subscription_types')->insertGetId(array_merge([
            'title' => $title,
            'allow_all_courses' => false,
            'allow_all_specializations' => false,
            'allow_all_webinars' => false,
            'allow_zoom_content' => false,
            'allow_webinar_content' => false,
        ], $flags));
    }

    private function subscribe(int $studentId, int $subscriptionId): void
    {
        DB::table('aca_student_subscriptions')->insert([
            'student_id' => $studentId,
            'subscription_id' => $subscriptionId,
            'status' => true,
            'date_start' => now()->subDay()->toDateString(),
            'date_end' => now()->addMonth()->toDateString(),
        ]);
    }

    private function register(int $studentId, int $courseId, bool $unlimited = true): void
    {
        DB::table('aca_cap_registrations')->insert([
            'student_id' => $studentId,
            'course_id' => $courseId,
            'unlimited' => $unlimited,
            'date_end' => $unlimited ? null : now()->addMonth()->toDateString(),
        ]);
    }
}

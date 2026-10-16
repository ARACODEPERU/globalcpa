<?php

namespace Modules\Academic\Services;

use App\Services\JobOffersAccess;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Modules\Academic\Entities\AcaCapRegistration;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaStudentSubscription;

/**
 * Punto unico para decidir si un alumno puede ver el contenido de un curso.
 *
 * El acceso ya no depende del nombre del plan: sale de los permisos editables
 * de cada tipo de suscripcion (aca_subscription_types). Renombrar un plan no
 * cambia lo que desbloquea.
 *
 * Acceso a un curso, en este orden:
 *   1. Matricula vigente (ilimitada o con date_end >= hoy).
 *   2. Suscripcion activa cuyo tipo permita la categoria del curso:
 *      programas de especializacion, cursos tipo Webinar o el resto de
 *      cursos y talleres. Los cursos/talleres gratis quedan abiertos a todos,
 *      pero especializacion y webinars siempre dependen de su check.
 *
 * Contenido dentro de un curso ya accesible (ver canSeeContent):
 *   - Meet/Zoom (is_file = 3): matricula, curso gratis o plan con acceso a
 *     programas de especializacion y su check de Meet/Zoom activado.
 *   - Webinar (is_file = 5): curso gratis o plan con acceso a programas de
 *     especializacion y su check de webinar activado.
 *   Sin el check de programas de especializacion, esos dos tipos de contenido
 *   se ocultan en vez de mostrarse a medias.
 *
 * Lo comparten el dashboard y las pantallas de cursos para que no divergan.
 */
class CourseAccessService
{
    public const CONTENT_ZOOM = 3;
    public const CONTENT_WEBINAR = 5;

    private const CATEGORY_SPECIALIZATION = 'specialization';
    private const CATEGORY_WEBINAR = 'webinar';
    private const CATEGORY_COURSES = 'courses';

    /**
     * Permisos ya calculados por alumno dentro de la misma peticion.
     *
     * @var array<int, array<string, bool>>
     */
    private array $flagsCache = [];

    /**
     * Suscripciones que cuentan como activas: las marcadas con status, o las
     * que siguen vigentes por fechas aunque el status no se haya refrescado.
     *
     * @return \Illuminate\Database\Eloquent\Builder<AcaStudentSubscription>
     */
    private function activeSubscriptionsQuery(int $studentId)
    {
        $today = Carbon::today();

        return AcaStudentSubscription::where('student_id', $studentId)
            ->where(function ($query) use ($today) {
                $query->where('status', true)
                    ->orWhere(function ($q) use ($today) {
                        $q->whereDate('date_start', '<=', $today)
                            ->whereDate('date_end', '>=', $today);
                    });
            });
    }

    /**
     * El alumno tiene alguna suscripcion activa.
     */
    public function hasActiveSubscription(int $studentId): bool
    {
        return $this->activeSubscriptionsQuery($studentId)->exists();
    }

    /**
     * Permisos en blanco (alumno sin suscripcion activa).
     *
     * @return array{courses: bool, specializations: bool, webinars: bool, zoom: bool, webinar_content: bool}
     */
    public static function emptyFlags(): array
    {
        return [
            'courses' => false,
            'specializations' => false,
            'webinars' => false,
            'zoom' => false,
            'webinar_content' => false,
        ];
    }

    /**
     * Permisos efectivos del alumno: la union de todos sus planes activos.
     *
     * @return array{courses: bool, specializations: bool, webinars: bool, zoom: bool, webinar_content: bool}
     */
    public function accessFlags(int $studentId): array
    {
        if (isset($this->flagsCache[$studentId])) {
            return $this->flagsCache[$studentId];
        }

        $subscriptions = $this->activeSubscriptionsQuery($studentId)
            ->with('subscription')
            ->get();

        $flags = self::emptyFlags();

        foreach ($subscriptions as $subscription) {
            $type = $subscription->subscription;

            if (! $type) {
                continue;
            }

            $flags['courses'] = $flags['courses'] || (bool) $type->allow_all_courses;
            $flags['specializations'] = $flags['specializations'] || (bool) $type->allow_all_specializations;
            $flags['webinars'] = $flags['webinars'] || (bool) $type->allow_all_webinars;
            $flags['zoom'] = $flags['zoom'] || (bool) $type->allow_zoom_content;
            $flags['webinar_content'] = $flags['webinar_content'] || (bool) $type->allow_webinar_content;
        }

        return $this->flagsCache[$studentId] = $flags;
    }

    /**
     * Categoria de acceso a la que pertenece un curso segun su tipo.
     */
    public function courseCategory(?string $typeDescription): string
    {
        $type = trim((string) $typeDescription);

        if (strcasecmp($type, JobOffersAccess::SPECIALIZATION_TYPE) === 0) {
            return self::CATEGORY_SPECIALIZATION;
        }

        if (strcasecmp($type, 'Webinar') === 0) {
            return self::CATEGORY_WEBINAR;
        }

        return self::CATEGORY_COURSES;
    }

    /**
     * Decide si los permisos dados alcanzan a la categoria del curso.
     *
     * Un curso/taller gratis es visible para todos; los programas de
     * especializacion y los webinars, aunque sean gratis, solo se abren con su
     * check o con matricula, para que ese permiso realmente los controle.
     *
     * @param array<string, bool> $flags
     */
    public function canAccessCategory(array $flags, ?string $typeDescription, bool $isFreeCourse = false): bool
    {
        return match ($this->courseCategory($typeDescription)) {
            self::CATEGORY_SPECIALIZATION => $flags['specializations'],
            self::CATEGORY_WEBINAR => $flags['webinars'],
            default => $flags['courses'] || $isFreeCourse,
        };
    }

    /**
     * Matricula vigente del alumno en un curso: ilimitada o con fecha fin
     * igual o posterior a hoy.
     */
    public function isRegistered(int $studentId, int $courseId): bool
    {
        $today = Carbon::today();

        return AcaCapRegistration::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->where(function ($query) use ($today) {
                $query->where('unlimited', true) // cursos ilimitados siempre cuentan
                    ->orWhere(function ($q) use ($today) {
                        $q->where('unlimited', false) // explicito: solo cursos no ilimitados
                            ->whereDate('date_end', '>=', $today); // aun vigentes
                    });
            })
            ->exists();
    }

    /**
     * Decide si el alumno puede acceder al contenido del curso.
     */
    public function canAccess(int $studentId, AcaCourse $course): bool
    {
        if (! $studentId) {
            return false;
        }

        // Matricula vigente
        if ($this->isRegistered($studentId, $course->id)) {
            return true;
        }

        // Suscripcion activa segun la categoria del curso (y gratis para
        // cursos y talleres)
        return $this->canAccessCategory(
            $this->accessFlags($studentId),
            $course->type_description,
            $course->price == 0 || is_null($course->price)
        );
    }

    /**
     * Decide si un contenido concreto es visible dentro de un curso al que el
     * alumno ya tiene acceso.
     *
     * Los tipos de contenido Meet/Zoom y webinar son propios de los programas
     * de especializacion: solo se muestran a los planes con el check de acceso
     * a esos programas. Si el plan no los incluye, se ocultan (en vez de
     * ofrecer contenido a medias); sus checks de contenido no tienen efecto.
     *
     * La matricula y los cursos gratis siempre muestran el contenido que trae el
     * propio curso, porque ese acceso se pago/asigno por el curso concreto y no
     * depende del plan.
     *
     * @param array<string, bool> $flags
     * @param int|string|null $isFile
     */
    public function canSeeContent(array $flags, $isFile, bool $isMatriculated, bool $isFreeCourse): bool
    {
        $isFile = (int) $isFile;

        // Los dos checks de contenido dependen del acceso a programas de
        // especializacion del plan.
        $specializations = $flags['specializations'];

        if ($isFile === self::CONTENT_ZOOM) {
            return $isMatriculated || $isFreeCourse || ($specializations && $flags['zoom']);
        }

        if ($isFile === self::CONTENT_WEBINAR) {
            return $isFreeCourse || ($specializations && $flags['webinar_content']);
        }

        return true;
    }

    /**
     * Deja una lista de cursos lista para el payload de "Mis cursos".
     *
     *   - Los cursos sin acceso (can_view = false) sueltan su arbol de
     *     modulos/temas/contenidos: el listado los muestra solo como tarjeta, y
     *     asi sus enlaces Meet/Zoom no viajan al navegador.
     *   - En los cursos accesibles se quitan los contenidos que el plan no
     *     permite ver (los mismos que filtra la pantalla de la leccion).
     *
     * Debe llamarse despues de calcular todo lo que dependa de los contenidos
     * (por ejemplo contents_total): soltar o filtrar la relacion no se deshace.
     *
     * @param Collection<int, AcaCourse> $courses
     * @param array<string, bool> $flags
     * @return Collection<int, AcaCourse>
     */
    public function hideContentsNotAllowed(Collection $courses, array $flags, int $studentId): Collection
    {
        // Matricula existente: el mismo criterio que usa la pantalla de la
        // leccion, para que el listado y la leccion no se contradigan.
        $registeredCourseIds = AcaCapRegistration::where('student_id', $studentId)
            ->pluck('course_id')
            ->map(fn ($id) => (int) $id)
            ->all();

        return $courses->each(function ($course) use ($flags, $registeredCourseIds) {
            if (! $course->can_view) {
                $course->unsetRelation('modules');

                return;
            }

            $this->filterCourseContents(
                $course,
                $flags,
                in_array((int) $course->id, $registeredCourseIds, true)
            );
        });
    }

    /**
     * Quita de un curso ya cargado (modules.themes.contents) los contenidos que
     * el alumno no puede ver, sin recargar nada.
     *
     * @param array<string, bool> $flags
     */
    private function filterCourseContents(AcaCourse $course, array $flags, bool $isMatriculated): void
    {
        if (! $course->relationLoaded('modules')) {
            return;
        }

        $isFreeCourse = $course->price == 0 || is_null($course->price);

        $course->modules->each(function ($module) use ($flags, $isMatriculated, $isFreeCourse) {
            if (! $module->relationLoaded('themes')) {
                return;
            }

            $module->themes->each(function ($theme) use ($flags, $isMatriculated, $isFreeCourse) {
                if (! $theme->relationLoaded('contents')) {
                    return;
                }

                $theme->setRelation('contents', $theme->contents
                    ->filter(fn ($content) => $this->canSeeContent($flags, $content->is_file, $isMatriculated, $isFreeCourse))
                    ->values());
            });
        });
    }
}

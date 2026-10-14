<?php

namespace Modules\Academic\Services;

use Carbon\Carbon;
use Modules\Academic\Entities\AcaCapRegistration;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaStudentSubscription;

/**
 * Punto unico para decidir si un alumno puede ver el contenido de un curso.
 *
 * Reglas, evaluadas en este orden:
 *   1. Premium VIP: acceso a todos los cursos, incluidos los de especializacion.
 *   2. Programas de especializacion: solo con matricula.
 *   3. Suscripcion activa: acceso a todo lo que no sea especializacion.
 *   4. Matricula vigente (ilimitada o con date_end >= hoy).
 *   5. Curso gratis.
 *
 * Lo comparten las pantallas que muestran cursos (mis cursos, lecciones y el
 * dashboard del alumno) para que no se desincronicen entre si.
 */
class CourseAccessService
{
    /**
     * Suscripcion activa del alumno (status = true).
     */
    public function hasActiveSubscription(int $studentId): bool
    {
        return AcaStudentSubscription::where('student_id', $studentId)
            ->where('status', true)
            ->exists();
    }

    /**
     * Suscripcion Premium VIP activa: da acceso a todos los cursos.
     */
    public function hasPremiumVip(int $studentId): bool
    {
        return AcaStudentSubscription::where('student_id', $studentId)
            ->where('status', true)
            ->whereHas('subscription', function ($query) {
                $query->where('title', 'LIKE', '%Premium VIP%');
            })
            ->exists();
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

        // Condicion VIP: puede ver TODOS los cursos (incluido especializacion)
        if ($this->hasPremiumVip($studentId)) {
            return true;
        }

        // Programas de especializacion: solo matriculados
        if ($course->type_description === 'Programas de especialización') {
            return AcaCapRegistration::where('student_id', $studentId)
                ->where('course_id', $course->id)
                ->exists();
        }

        // Suscripcion activa: acceso a todo lo que no sea especializacion
        if ($this->hasActiveSubscription($studentId)) {
            return true;
        }

        // Matricula vigente
        if ($this->isRegistered($studentId, $course->id)) {
            return true;
        }

        // Curso gratis
        if ($course->price == 0 || is_null($course->price)) {
            return true;
        }

        return false;
    }
}

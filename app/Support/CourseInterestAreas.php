<?php

namespace App\Support;

/**
 * Areas de interes que se ofrecen en el paso 2 de la landing de curso gratis.
 *
 * Es una lista fija (no son cursos de aca_courses), por eso se guarda como
 * texto y no como course_id.
 */
class CourseInterestAreas
{
    public const AREAS = [
        'Derecho tributario',
        'Derecho laboral',
        'NIIF de Contabilidad',
        'Normas internacionales de Auditoría',
        'Coaching & Liderazgo',
        'Inteligencia artificial aplicada a la contabilidad',
        'NIIF S1 y S2',
        'Finanzas Corporativas',
        'Ciberseguridad',
    ];

    /**
     * Listado completo de areas disponibles.
     */
    public static function all(): array
    {
        return self::AREAS;
    }
}

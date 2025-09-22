<?php

namespace App\View\Components\Courses;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;
use Modules\Onlineshop\Entities\OnliItem;

class ListCard extends Component
{
    protected $courses;
    protected $types;

    public function __construct()
    {
        $this->courses = OnliItem::with('course.teacher.person')->orderBy('id', 'desc')->get();
        $this->types = getEnumValues('onli_items', 'additional', 0, 1);
    }

    /**
     * Limitar caracteres de los títulos de los cursos.
     */
    protected function limitCourseTitles($courses, $length = 45)
    {
        return $courses->map(function ($course) use ($length) {
            $course->name = mb_substr($course->name, 0, $length);
            return $course;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $limitedCourses = $this->limitCourseTitles($this->courses, 4); // Limita a 50 caracteres

        return view('components.courses.list-card', [
            'courses' => $limitedCourses,
            'types' => $this->types,
        ]);
    }
}


// class ListCard extends Component
// {

//     protected $courses_title;
//     protected $courses;
//     protected $types;

//     public function __construct()
//     {
//         $this->courses = OnliItem::with('course.teacher.person')->orderBy('id','desc')->get();
//         $this->types = getEnumValues('onli_items', 'additional', 0, 1);
            
//     }

//     public function render(): View|Closure|string
//     {
//         return view('components.courses.list-card', [
//             'courses' => $this->courses,
//             'types' => $this->types,
//         ]);
//     }
// }

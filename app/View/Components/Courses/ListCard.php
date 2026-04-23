<?php

namespace App\View\Components\Courses;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;
use Modules\Onlineshop\Entities\OnliItem;
use Modules\Academic\Entities\AcaCourseLanding;

class ListCard extends Component
{
    protected $courses;
    protected $types;

    public function __construct()
    {
        $this->courses = OnliItem::whereHas('course')
            ->with([
                'course.teacher.person',
                // Cargamos la relación de landing de una vez para evitar consultas en el bucle
                'course.landing'
            ])
            ->orderBy('id', 'desc')
            ->get()
            ->map(function ($onliItem) {
                /** * Accedemos a la relación cargada.
                 * Asumiendo que en el modelo Course definiste: public function landing()
                 */
                $landing = $onliItem->course->landing;

                if ($landing && $landing->url_slug && $landing->is_published) {
                    $onliItem->url_slug = $landing->url_slug;
                }

                return $onliItem;
            });

        $this->types = getEnumValues('onli_items', 'additional', 0, 1);
    }
    public function render(): View|Closure|string
    {

        return view('components.courses.list-card', [
            'courses' => $this->courses,
            'types' => $this->types,
            'p' => 9, //numero maximo de cursos a mostrar
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

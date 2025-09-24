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

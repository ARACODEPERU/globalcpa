<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSection;
use Modules\Onlineshop\Entities\OnliItem;

class Sidebar extends Component
{

    protected $logo;
    // protected $courses_title;
    protected $courses;
    protected $types;

    public function __construct()
    {

        $this->logo = CmsSection::where('component_id', 'logos_1')
            ->join('cms_section_items', 'section_id', 'cms_sections.id')
            ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
            ->select(
                'cms_items.content',
                'cms_section_items.position'
            )
            ->orderBy('cms_section_items.position')
            ->get();

        // $this->courses_title = CmsSection::where('component_id', 'cursos_area_5')
        //     ->join('cms_section_items', 'section_id', 'cms_sections.id')
        //     ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
        //     ->select(
        //         'cms_items.content',
        //         'cms_section_items.position'
        //     )
        //     ->orderBy('cms_section_items.position')
        //     ->get();

        //$this->courses = OnliItem::with('course')->orderBy('id','desc')->get();
        $this->courses = OnliItem::select('id', 'name', 'additional')->latest()->get();
        $this->types = getEnumValues('onli_items', 'additional', 0, 1);

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar', [
            'logo' => $this->logo,
            // 'courses_title' => $this->courses_title,
            'courses' => $this->courses,
            'types' => $this->types,
            'p' => 6,   //numeros maximo de cursos mostrados en el sidebar
            'lines' => 2,  //lineas mostradas del titulo del curso es una variable para el css
        ]);
    }
}

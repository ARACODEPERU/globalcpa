<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\CMS\Entities\CmsSectionItem;

class TeachersAll extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->teachers = CmsSectionItem::with('item.items')
        ->where('section_id', 5)
        ->orderBy('position', 'asc')
        ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.teachers-all', [
            'teachers' => $this->teachers
        ]);
    }
}

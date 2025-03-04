<?php

namespace App\View\Components\Blog;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Modules\Blog\Entities\BlogArticle;
use Modules\CMS\Entities\CmsSection;


class Presentation extends Component
{

    // protected $blog_title;
    protected $blogs;

    public function __construct()
    {

        // $this->blog_title = CmsSection::where('component_id', 'blog_area_10')
        //     ->join('cms_section_items', 'section_id', 'cms_sections.id')
        //     ->join('cms_items', 'cms_section_items.item_id', 'cms_items.id')
        //     ->select(
        //         'cms_items.content',
        //         'cms_section_items.position'
        //     )
        //     ->orderBy('cms_section_items.position')
        //     ->get();

        $this->blogs = BlogArticle::with("author")->limit(3)
                                    ->orderBy('id','desc')
                                    ->get();

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog.presentation', [
            'blogs' => $this->blogs
        ]);
    }
}

<?php

namespace Modules\CMS\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route as RouteFacade;
use Inertia\Inertia;
use Modules\CMS\Entities\CmsPage;
use Modules\CMS\Entities\CmsPageSection;
use Modules\CMS\Entities\CmsSection;
use Modules\CMS\Entities\CmsSectionItem;

class CMSController extends Controller
{
    public function dashboard()
    {
    }
    public function apiGetPageData($page_id)
    {
        //$page = CmsPageSection::with('sections.items.item')->where('page_id', $page_id)->get();

        $page = CmsPageSection::with(['sections.items' => function ($query) {
            $query->orderBy('position', 'asc'); // Ordena por el campo 'position' de la tabla 'cms_section_items'
        }, 'sections.items.item'])->where('page_id', $page_id)->get();

        return response()->json([
            'page' => $page
        ]);
    }
    public function apiGetSectionGroupData($id)
    {
        //$section = CmsSection::where('component_id', $id)->first();
        $items = CmsSectionItem::with('item.items')->where('section_id', $id)->get();

        return response()->json([
            'items' => $items
        ]);
    }

    /**
     * Display the sitemap XML viewer page.
     */
    public function sitemap()
    {
        $sitemapPath = public_path('sitemap.xml');
        $sitemapContent = '';
        $exists = false;

        if (File::exists($sitemapPath)) {
            $sitemapContent = File::get($sitemapPath);
            $exists = true;
        }

        return Inertia::render('CMS::Sitemap/Index', [
            'sitemapContent' => $sitemapContent,
            'sitemapExists' => $exists,
            'appUrl' => config('app.url'),
        ]);
    }

    /**
     * Generate or update the sitemap.xml file with project routes.
     */
    public function sitemapGenerate()
    {
        $appUrl = config('app.url');
        $dateNow = now()->format('Y-m-d');

        // Public routes to include in sitemap
        $sitemapRoutes = [
            ['path' => '/', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['path' => '/home', 'priority' => '1.0', 'changefreq' => 'daily'],
            ['path' => '/home2', 'priority' => '0.9', 'changefreq' => 'daily'],
            ['path' => '/nosotros', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/docentes', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/academy', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/el-amauta-de-las-niif', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/planes-de-suscripcion', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/politicas-de-devolucion', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/Terminos-y-condiciones', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/politicas_privacidad', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/cursos', 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['path' => '/carrito', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['path' => '/metodos-de-pago', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/pagar', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['path' => '/libro-de-reclamaciones', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/e-libro-de-reclamaciones', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/email', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/stories/policies', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/stories/contact-us', 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['path' => '/prices/academic', 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['path' => '/find/invoice', 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['path' => '/get-csrf-token', 'priority' => '0.0', 'changefreq' => 'weekly'],
        ];

        // Dynamic: Add CMS pages marked as main
        $cmsPages = CmsPage::where('status', true)->where('main', true)->get();
        foreach ($cmsPages as $page) {
            $pagePath = '/' . trim($page->route, '/');
            // Avoid duplicates
            if (!collect($sitemapRoutes)->contains('path', $pagePath)) {
                $sitemapRoutes[] = [
                    'path' => $pagePath,
                    'priority' => '0.8',
                    'changefreq' => 'monthly',
                ];
            }
        }

        // Dynamic: Add published blog articles
        try {
            $blogArticles = \Modules\Blog\Entities\BlogArticle::where('is_published', true)
                ->select('url', 'updated_at')
                ->get();

            foreach ($blogArticles as $article) {
                $articlePath = '/article/' . $article->url;
                if (!collect($sitemapRoutes)->contains('path', $articlePath)) {
                    $sitemapRoutes[] = [
                        'path' => $articlePath,
                        'priority' => '0.7',
                        'changefreq' => 'weekly',
                    ];
                }
            }
        } catch (\Exception $e) {
            // Blog module may not be available, skip silently
        }

        // Dynamic: Add published course landings
        try {
            $courses = \Modules\Onlineshop\Entities\OnliItem::whereHas('course')
                ->with(['course' => function ($q) {
                    $q->with('landing');
                }])
                ->get();

            foreach ($courses as $course) {
                $landing = $course->course?->landing;
                if ($landing && filled($landing->url_slug) && ($landing->is_published ?? false)) {
                    $coursePath = '/curso/' . $landing->url_slug;
                    if (!collect($sitemapRoutes)->contains('path', $coursePath)) {
                        $sitemapRoutes[] = [
                            'path' => $coursePath,
                            'priority' => '0.9',
                            'changefreq' => 'weekly',
                        ];
                    }
                }
            }
        } catch (\Exception $e) {
            // Onlineshop module may not be available, skip silently
        }

        // Build XML
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($sitemapRoutes as $route) {
            $url = rtrim($appUrl, '/') . $route['path'];
            $xml .= '  <url>' . "\n";
            $xml .= '    <loc>' . htmlspecialchars($url, ENT_XML1, 'UTF-8') . '</loc>' . "\n";
            $xml .= '    <lastmod>' . $dateNow . '</lastmod>' . "\n";
            $xml .= '    <changefreq>' . $route['changefreq'] . '</changefreq>' . "\n";
            $xml .= '    <priority>' . $route['priority'] . '</priority>' . "\n";
            $xml .= '  </url>' . "\n";
        }

        $xml .= '</urlset>';

        // Write to public/sitemap.xml
        $sitemapPath = public_path('sitemap.xml');
        File::put($sitemapPath, $xml);

        return response()->json([
            'success' => true,
            'message' => 'Sitemap generado correctamente con ' . count($sitemapRoutes) . ' URLs.',
            'content' => $xml,
            'total_urls' => count($sitemapRoutes),
        ]);
    }
}

<?php

namespace App\Console\Commands;

use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaCourseLanding;
use Modules\CMS\Entities\CmsLanding;
use Modules\Blog\Entities\BlogArticle;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'sitemap:generate
        {--output=public/sitemap.xml : Path where the sitemap will be saved}
        {--limit=5000 : Max items per provider}';

    protected $description = 'Generate sitemap.xml with static and dynamic public routes for production.';

    protected string $baseUrl = 'https://academy.globalcpaperu.com';

    public function handle(): int
    {
        $this->info('Generando sitemap...');

        $limit = (int) $this->option('limit');
        if ($limit < 1) {
            $limit = 5000;
        }

        $urls = $this->getStaticUrls();
        $this->info('Rutas estáticas: ' . count($urls));

        foreach ($this->getDynamicUrlProviders($limit) as $provider) {
            $dynamic = $provider->__invoke();
            $urls = array_merge($urls, $dynamic);
            $this->info('Rutas dinámicas añadidas desde ' . $provider->getName() . ': ' . count($dynamic));
        }

        $xml = $this->buildXml($urls);

        $path = $this->getOutputPath();
        File::ensureDirectoryExists(dirname($path));
        File::put($path, $xml);

        $this->info('Sitemap generado en: ' . $path);
        return Command::SUCCESS;
    }

    protected function getStaticUrls(): array
    {
        $now = $this->now()->toDateString();

        return [
            ['loc' => '/', 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => '/home', 'changefreq' => 'daily', 'priority' => '1.0'],
            ['loc' => '/home2', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => '/nosotros', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => '/docentes', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => '/academy', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => '/el-amauta-de-las-niif', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => '/planes-de-suscripcion', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => '/politicas-de-devolucion', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/Terminos-y-condiciones', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/politicas_privacidad', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/cursos', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['loc' => '/carrito', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => '/metodos-de-pago', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/pagar', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => '/libro-de-reclamaciones', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/e-libro-de-reclamaciones', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/email', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/stories/policies', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/stories/contact-us', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['loc' => '/prices/academic', 'changefreq' => 'monthly', 'priority' => '0.8'],
            ['loc' => '/find/invoice', 'changefreq' => 'weekly', 'priority' => '0.8'],
            ['loc' => '/dashboard', 'changefreq' => 'daily', 'priority' => '0.9'],
        ]->map(function (array $route) use ($now): array {
            return [
                'loc' => $this->baseUrl . $route['loc'],
                'lastmod' => $now,
                'changefreq' => $route['changefreq'],
                'priority' => $route['priority'],
            ];
        })->values()->toArray();
    }

    protected function getDynamicUrlProviders(int $limit): array
    {
        return [
            $this->makeDynamicProvider(
                'Landings CMS activos',
                fn (): array => $this->cmsLandingUrls($limit)
            ),
            $this->makeDynamicProvider(
                'Landing de cursos publicados',
                fn (): array => $this->courseLandingUrls($limit)
            ),
            $this->makeDynamicProvider(
                'Artículos de blog publicados',
                fn (): array => $this->blogArticleUrls($limit)
            ),
        ];
    }

    protected function makeDynamicProvider(callable $urlFn, string $name): object
    {
        return new class($urlFn, $name) {
            public function __construct(private $urlFn, private $name) {}

            public function __invoke(): array
            {
                return ($this->urlFn)();
            }

            public function getName(): string
            {
                return (string) $this->name;
            }
        };
    }

    protected function getCurrentClass(): string
    {
        return (new \ReflectionObject($this))->getShortName();
    }

    protected function cmsLandingUrls(int $limit): array
    {
        if (!class_exists(CmsLanding::class)) {
            return [];
        }

        $models = CmsLanding::query()
            ->whereNotNull('slug')
            ->where('date_end', '>=', $this->now()->toDateString())
            ->orderByDesc('date_end')
            ->limit($limit)
            ->get(['slug', 'date_start', 'date_end', 'updated_at']);

        return $models->map(fn (CmsLanding $landing): array => [
            'loc' => $this->baseUrl . '/landing/' . $landing->slug,
            'lastmod' => $landing->updated_at?->toDateString() ?? $this->now()->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ])->values()->toArray();
    }

    protected function courseLandingUrls(int $limit): array
    {
        if (!class_exists(AcaCourseLanding::class)) {
            return [];
        }

        $models = AcaCourseLanding::query()
            ->where('is_published', true)
            ->whereNotNull('url_slug')
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get(['url_slug', 'updated_at']);

        return $models->map(fn (AcaCourseLanding $landing): array => [
            'loc' => $this->baseUrl . '/landing/' . $landing->url_slug,
            'lastmod' => $landing->updated_at?->toDateString() ?? $this->now()->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ])->values()->toArray();
    }

    protected function blogArticleUrls(int $limit): array
    {
        if (!class_exists(BlogArticle::class)) {
            return [];
        }

        $models = BlogArticle::query()
            ->where('status', 'public')
            ->orderByDesc('updated_at')
            ->limit($limit)
            ->get(['url', 'updated_at']);

        return $models->map(fn (BlogArticle $article): array => [
            'loc' => $this->baseUrl . '/article/' . $article->url,
            'lastmod' => $article->updated_at?->toDateString() ?? $this->now()->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '0.8',
        ])->values()->toArray();
    }

    protected function buildXml(array $urls): string
    {
        $now = $this->now()->toAtomString();
        $parts = ['<?xml version="1.0" encoding="UTF-8"?>', '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'];

        foreach ($urls as $url) {
            $parts[] = <<<XML
  <url>
    <loc>{$this->escapeXml($url['loc'])}</loc>
    <lastmod>{$this->escapeXml($url['lastmod'])}</lastmod>
    <changefreq>{$this->escapeXml($url['changefreq'])}</changefreq>
    <priority>{$this->escapeXml($url['priority'])}</priority>
  </url>
XML;
        }

        $parts[] = '</urlset>';

        return implode("\n", $parts) . "\n";
    }

    protected function escapeXml(string $text): string
    {
        return str_replace(['&', '<', '>', '"', "'"], ['&amp;', '&lt;', '&gt;', '&quot;', '&apos;'], $text);
    }

    protected function getOutputPath(): string
    {
        $path = $this->option('output');

        if (!File::isAbsolute($path)) {
            $path = base_path($path);
        }

        return $path;
    }

    protected function now(): Carbon
    {
        return Carbon::now()->timezone('America/Lima');
    }
}

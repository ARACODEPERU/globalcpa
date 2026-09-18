<?php

namespace Tests\Unit\Modules\Blog;

use Tests\TestCase;

/*
 * El conteo de vistas del blog vive en tres piezas que tienen que estar todas en su
 * sitio: el endpoint POST /blog/{url}/vista (el unico que incrementa), los renders que
 * NO deben incrementar (si no, cada carga suma y el limite de 24h no sirve de nada) y
 * el frontend que avisa al endpoint desde la web publica y desde el panel del alumno.
 * Estas pruebas fijan ese contrato completo.
 */
class ArticleViewCounterWiringTest extends TestCase
{
    private const ARTICLE_VIEW_ROUTE = 'blog_article_view';
    private const COUNTER_ELEMENT_ID = 'article-views-count';
    private const HELPER = 'resources/js/utils/blogViewCounter.js';

    public function test_la_ruta_del_endpoint_existe(): void
    {
        $routes = $this->read('routes/web.php');

        $this->assertStringContainsString("Route::post('/blog/{url}/vista'", $routes);
        $this->assertStringContainsString("->name('" . self::ARTICLE_VIEW_ROUTE . "')", $routes);
    }

    public function test_el_endpoint_es_el_unico_que_incrementa_las_vistas(): void
    {
        $endpoint = $this->methodBody(
            $this->read('app/Http/Controllers/WebPageController.php'),
            'public function blog_article_view',
            'private function createFreeCartSale'
        );

        $this->assertMatchesRegularExpression(
            '/^\\s*\\$article->increment\\(\'views\'\\);/m',
            $endpoint,
            'El endpoint debe incrementar: si no, la vista se registra pero el contador nunca sube.'
        );
        $this->assertStringContainsString("'views' => (int) \$article->views", $endpoint);
    }

    public function test_el_render_publico_del_articulo_ya_no_incrementa(): void
    {
        $body = $this->methodBody(
            $this->read('Modules/Blog/Http/Controllers/BlogController.php'),
            'public function article(',
            'public function policies('
        );

        $this->assertDoesNotMatchRegularExpression(
            '/^\\s*\\$article->increment\\(\'views\'\\);/m',
            $body,
            'Si el render incrementa, cada recarga suma y el limite de 24h por navegador queda anulado.'
        );
    }

    public function test_el_render_del_panel_del_alumno_ya_no_incrementa(): void
    {
        $body = $this->methodBody(
            $this->read('Modules/Blog/Http/Controllers/BlogArticlesController.php'),
            'public function show(',
            'public function searchArticles('
        );

        $this->assertDoesNotMatchRegularExpression(
            '/^\\s*\\$article->increment\\(\'views\'\\);/m',
            $body,
            'El panel del alumno debe contar por el endpoint, no al renderizar.'
        );
    }

    public function test_el_blade_publico_expone_el_contador_con_su_slug_y_su_url(): void
    {
        $blade = $this->read('resources/views/pages/blog-articulo.blade.php');

        $this->assertStringContainsString('id="' . self::COUNTER_ELEMENT_ID . '"', $blade);
        $this->assertStringContainsString('data-slug="{{ $article->url }}"', $blade);
        $this->assertStringContainsString("data-url=\"{{ route('" . self::ARTICLE_VIEW_ROUTE . "', \$article->url) }}\"", $blade);
    }

    public function test_la_web_publica_inicializa_el_contador(): void
    {
        $webpage = $this->read('resources/js/webpage.js');

        $this->assertStringContainsString('from "./utils/blogViewCounter"', $webpage);
        $this->assertStringContainsString('initBlogArticleViewCounter()', $webpage);
    }

    public function test_el_panel_del_alumno_registra_la_vista_de_su_articulo(): void
    {
        $show = $this->read('Modules/Blog/Resources/assets/js/Pages/articles/Show.vue');

        $this->assertStringContainsString("from '@/utils/blogViewCounter'", $show);
        $this->assertStringContainsString('onMounted(', $show);
        $this->assertStringContainsString('registerBlogArticleView({ slug: props.article?.url })', $show);
    }

    public function test_el_helper_compartido_define_la_ventana_de_24_horas(): void
    {
        $helper = $this->read(self::HELPER);

        $this->assertStringContainsString('VIEW_TTL_MS = 24 * 60 * 60 * 1000', $helper);
        $this->assertStringContainsString('blog_viewed_articles', $helper);
        // El id del contador es un contrato entre el helper y el blade.
        $this->assertStringContainsString("getElementById('" . self::COUNTER_ELEMENT_ID . "')", $helper);
    }

    /**
     * La leccion del helper menuRoute: una llamada a route() sin proteger lanza al
     * importar y deja la pagina sin renderizar. Aqui se usa window.route dentro de
     * try/catch, con respaldo al prefijo /blog.
     */
    public function test_el_helper_no_llama_a_route_sin_proteger(): void
    {
        $helper = $this->read(self::HELPER);

        $this->assertStringContainsString("window.route('" . self::ARTICLE_VIEW_ROUTE . "'", $helper);
        $this->assertStringNotContainsString("\n            route('", $helper);
    }

    private function methodBody(string $source, string $from, string $to): string
    {
        $start = strpos($source, $from);

        $this->assertNotFalse($start, "No se encontro el metodo: $from");

        $end = strpos($source, $to, $start);

        $this->assertNotFalse($end, "No se encontro el limite del metodo: $to");

        return substr($source, $start, $end - $start);
    }

    private function read(string $relativePath): string
    {
        $path = base_path($relativePath);

        $this->assertFileExists($path);

        return file_get_contents($path);
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Blade;
use Tests\TestCase;

/*
 * Renderiza <x-header /> en el contexto de una ruta dada (sin base de datos ni
 * HTTP) para comprobar cuándo aparece la barra de migas y el espaciador que
 * compensa la altura del header fijo.
 */
uses(TestCase::class);

function renderHeaderForRoute(string $routeName, array $breadcrumb = []): string
{
    $route = new RoutingRoute(['GET'], '/test', []);
    $route->name($routeName);

    $request = Request::create('/test');
    $request->setRouteResolver(fn () => $route);

    app()->instance('request', $request);

    return Blade::render('<x-header :breadcrumb="$breadcrumb" />', ['breadcrumb' => $breadcrumb]);
}

it('pinta la barra de migas en las rutas del mapa', function () {
    $html = renderHeaderForRoute('politicas_devoluciones');

    expect($html)
        ->toContain('<nav class="custom-breadcrumb-bar"')
        ->toContain('<div class="custom-breadcrumb-spacer"')
        ->toContain('aria-current="page"')
        ->toContain('Políticas de devolución')
        ->toContain(route('index_main'))
        ->toContain('BreadcrumbList');
});

it('no pinta la barra en el inicio ni en rutas con migas propias del hero', function () {
    $sinBarra = ['index_main', 'index_main_home', 'web_courses', 'web_faq', 'web_fag', 'web_teachers', 'web_about'];

    foreach ($sinBarra as $routeName) {
        expect(renderHeaderForRoute($routeName))
            ->not->toContain('<nav class="custom-breadcrumb-bar"')
            ->not->toContain('<div class="custom-breadcrumb-spacer"');
    }
});

it('emite datos estructurados BreadcrumbList válidos', function () {
    $html = renderHeaderForRoute('blog_principal');

    preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $html, $matches);

    $schema = json_decode(trim($matches[1] ?? ''), true);

    expect($schema['@type'] ?? null)->toBe('BreadcrumbList')
        ->and(collect($schema['itemListElement'] ?? [])->pluck('name')->all())->toBe(['Inicio', 'Blog'])
        ->and($schema['itemListElement'][0]['item'])->toBe(route('index_main'))
        ->and($schema['itemListElement'][1]['item'])->toBe(url()->current());
});

it('usa los niveles enviados por la página', function () {
    $html = renderHeaderForRoute('web_course_description', [
        ['label' => 'Cursos', 'route' => 'web_courses'],
        ['label' => 'NIIF aplicado a la práctica'],
    ]);

    expect($html)
        ->toContain('<nav class="custom-breadcrumb-bar"')
        ->toContain('NIIF aplicado a la práctica')
        ->toContain(route('web_courses'));
});

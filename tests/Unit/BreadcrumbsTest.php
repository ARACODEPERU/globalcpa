<?php

use App\Services\Breadcrumbs;
use Tests\TestCase;

/*
 * El header público pinta migas solo cuando la ruta (o la página) declara
 * al menos dos niveles. Estas pruebas cubren el resolutor, que no toca la
 * base de datos: los tests de página completa no son viables porque
 * <x-sidebar /> usa "SHOW COLUMNS" de MySQL y sqlite no lo soporta.
 */
uses(TestCase::class);

it('resuelve las migas desde el mapa de rutas', function () {
    $crumbs = Breadcrumbs::forRoute('politicas_devoluciones');

    expect($crumbs)->toHaveCount(2)
        ->and($crumbs[0]['label'])->toBe('Inicio')
        ->and($crumbs[0]['url'])->toBe(route('index_main'))
        ->and($crumbs[1]['label'])->toBe('Políticas de devolución')
        ->and($crumbs[1]['url'])->toBeNull();
});

it('no pinta migas en rutas fuera del mapa ni sin ruta', function () {
    expect(Breadcrumbs::forRoute('web_courses'))->toBe([])
        ->and(Breadcrumbs::forRoute('index_main'))->toBe([])
        ->and(Breadcrumbs::forRoute(null))->toBe([]);
});

it('prioriza los niveles enviados por la página', function () {
    $crumbs = Breadcrumbs::forRoute('web_courses', ['label' => 'Kardex']);

    expect(collect($crumbs)->pluck('label')->all())->toBe(['Inicio', 'Kardex']);
});

it('normaliza los niveles navegables enviados por la página', function () {
    $crumbs = Breadcrumbs::forRoute('web_course_description', [
        ['label' => 'Cursos', 'route' => 'web_courses'],
        ['label' => 'NIIF aplicado a la práctica'],
    ]);

    expect(collect($crumbs)->pluck('label')->all())->toBe(['Inicio', 'Cursos', 'NIIF aplicado a la práctica'])
        ->and($crumbs[1]['url'])->toBe(route('web_courses'))
        ->and($crumbs[2]['url'])->toBeNull();
});

it('no duplica el nivel raíz cuando la página ya lo envía', function () {
    $crumbs = Breadcrumbs::forRoute('blog_principal', [
        ['label' => 'Inicio', 'url' => route('index_main')],
        ['label' => 'Blog'],
    ]);

    expect(collect($crumbs)->pluck('label')->all())->toBe(['Inicio', 'Blog']);
});

it('ignora niveles incompletos enviados por la página', function () {
    $crumbs = Breadcrumbs::forRoute('web_academy', [
        ['url' => route('web_courses')],
        ['label' => 'Academy'],
    ]);

    expect(collect($crumbs)->pluck('label')->all())->toBe(['Inicio', 'Academy']);
});

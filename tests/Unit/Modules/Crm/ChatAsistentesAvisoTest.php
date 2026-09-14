<?php

use Illuminate\Http\Request;
use Modules\CRM\Http\Controllers\CrmChatAsistenteController;
use Tests\TestCase;

/*
 * El chat de consultas ("/crm/chat/asistentes") opera como un usuario con rol
 * Asistente. Si no existe ninguno, o el asistente pedido en la URL ya no tiene el
 * rol, la vista debe avisarlo en vez de quedarse en silencio: el administrador
 * creeria que esta respondiendo como un asistente cuando en realidad lo hace como
 * el mismo.
 *
 * El aviso se resuelve sin tocar la base de datos (se le pasa la coleccion ya
 * armada), por eso vive en la suite Unit.
 */
uses(TestCase::class);

$aviso = function ($asistentes, string $url, $seleccionado) {
    $controller = new CrmChatAsistenteController();
    $method = new ReflectionMethod($controller, 'avisoAsistentes');
    $method->setAccessible(true);

    return $method->invoke($controller, $asistentes, Request::create($url, 'GET'), $seleccionado);
};

$asistentes = collect([
    ['user_id' => 5, 'person_id' => 3, 'full_name' => 'ALEX RICHARD', 'image' => null],
]);

it('avisa cuando no existe ningun usuario con rol Asistente', function () use ($aviso) {
    $mensaje = $aviso(collect(), '/crm/chat/asistentes', null);

    expect($mensaje)->toContain('No existe ningún usuario con el rol Asistente')
        ->and($mensaje)->toContain('Crea un usuario y asígnale el rol Asistente');
});

it('no avisa cuando hay asistentes y ninguno fue pedido', function () use ($aviso, $asistentes) {
    expect($aviso($asistentes, '/crm/chat/asistentes', null))->toBeNull();
});

it('no avisa cuando el asistente pedido si tiene el rol', function () use ($aviso, $asistentes) {
    expect($aviso($asistentes, '/crm/chat/asistentes?asistente=3', $asistentes->first()))->toBeNull();
});

it('avisa cuando el asistente pedido ya no tiene el rol', function () use ($aviso, $asistentes) {
    $mensaje = $aviso($asistentes, '/crm/chat/asistentes?asistente=9999', null);

    expect($mensaje)->toContain('no existe o ya no tiene el rol Asistente');
});

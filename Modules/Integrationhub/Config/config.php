<?php

return [
    'name' => 'Integrationhub',

    /*
    |--------------------------------------------------------------------------
    | Endpoint de registro de usuarios
    |--------------------------------------------------------------------------
    |
    | Endpoint de Integrationhub que recibe los datos de cada usuario recién
    | registrado. Se reutiliza el webhook de compras (n8n_post_compra) con el
    | mismo payload, pero el producto se envía como `blog-{curso}` para
    | distinguir el origen. Debe existir en el módulo con este nombre; si no
    | existe, se usa el endpoint de respaldo.
    |
    */
    'registration_endpoint' => env('INTEGRATIONHUB_REGISTRATION_ENDPOINT', 'n8n_post_compra'),

    /*
    |--------------------------------------------------------------------------
    | Endpoint de respaldo para el registro
    |--------------------------------------------------------------------------
    |
    | Si el endpoint principal no existe en el panel o responde error, el
    | registro se envía aquí con phone/email/first_name/last_name para no
    | perder el contacto. Debe existir en Integrationhub (por defecto el de
    | ChatLevel). Deja la variable vacía para desactivar el respaldo.
    |
    */
    'registration_fallback_endpoint' => env('INTEGRATIONHUB_REGISTRATION_FALLBACK_ENDPOINT', 'create_contact'),
];

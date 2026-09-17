<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Nivel raíz de todas las migas
    |--------------------------------------------------------------------------
    |
    | Se antepone a los niveles de cada ruta. Si la página ya envía un primer
    | nivel equivalente, no se duplica.
    |
    */
    'home' => [
        'label' => 'Inicio',
        'route' => 'index_main',
    ],

    /*
    |--------------------------------------------------------------------------
    | Rutas que muestran migas bajo el header
    |--------------------------------------------------------------------------
    |
    | Lista blanca: una ruta que no aparezca aquí no pinta barra de migas.
    | Cada nivel es:
    |   - un string, para el nivel final (no navegable), o
    |   - un arreglo ['label' => ..., 'route' => ..., 'params' => [...]] cuando
    |     el nivel enlaza a otra ruta.
    |
    | Las páginas que ya pintan sus propias migas dentro del hero (cursos, faq,
    | fag, docentes, testimonios, nosotros, por-que-cpa-academy, suscripciones,
    | búsqueda y blog-artículo) quedan fuera a propósito. Las páginas con datos
    | dinámicos (curso, landing) envían sus niveles por la prop :breadcrumb.
    |
    */
    'routes' => [
        'web_academy' => [
            'Academy',
        ],
        'blog_principal' => [
            'Blog',
        ],
        'web_book_amauta' => [
            'Publicación',
        ],
        'web_carrito' => [
            'Carrito',
        ],
        'politicas_devoluciones' => [
            'Políticas de devolución',
        ],
        'politicas_privacidad' => [
            'Política de privacidad',
        ],
        'certificado_validar' => [
            'Validar certificado',
        ],
    ],

];

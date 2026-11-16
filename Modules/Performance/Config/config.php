<?php

return [
    'name' => 'Performance',

    /*
    |--------------------------------------------------------------------------
    | Carpetas auditadas
    |--------------------------------------------------------------------------
    | Cada pestaña agrupa carpetas de imagenes. Las rutas que empiezan con
    | "@public/" se resuelven contra public_path(); el resto contra
    | storage_path('app/public') (lo que se sirve en /storage/...).
    */
    'tabs' => [
        'pages' => [
            'label' => 'Paginas',
            'description' => 'Imagenes de las paginas del sitio: CMS, landings, testimonios, instituciones y estaticas.',
            'roots' => [
                'uploads/cmsLanding',
                'uploads/cms',
                'uploads/landing',
                'uploads/testimonies',
                'uploads/institutions',
                '@public/img',
                '@public/bancos_logos',
            ],
        ],
        'courses' => [
            'label' => 'Cursos',
            'description' => 'Portadas de cursos y certificados.',
            'roots' => [
                'uploads/courses',
                'academic/certificates',
            ],
        ],
        'blog' => [
            'label' => 'Blog',
            'description' => 'Imagenes de articulos del blog.',
            'roots' => [
                'uploads/blog',
            ],
        ],
        'others' => [
            'label' => 'Otros',
            'description' => 'Avatares de usuarios, fotos de alumnos y archivos sueltos de uploads.',
            'roots' => [
                'uploads/students',
                'uploads/teachers',
                'users',
            ],
        ],
    ],

    // Extensiones consideradas imagenes
    'image_extensions' => ['jpg', 'jpeg', 'png', 'webp', 'gif', 'bmp'],

    // Extensiones que el optimizador puede reescribir
    'resizable_extensions' => ['jpg', 'jpeg', 'png', 'webp'],

    // Umbrales para marcar un archivo como mejorable
    'thresholds' => [
        'bytes' => 300 * 1024,
        'width' => 1920,
    ],

    // Copia de seguridad antes de sobrescribir (mismo nombre, otra carpeta)
    'backup_path' => 'performance-backups',

    'quality' => [
        'min' => 55,
        'max' => 95,
        'default' => 82,
    ],

    'max_targets_per_request' => 200,

    // Limpieza de carpetas temporales
    'cleanup' => [
        'days' => env('PERFORMANCE_CLEANUP_DAYS', 7),
        'targets' => [
            ['label' => 'Certificados temporales', 'path' => storage_path('app/public/tmp_html_cert')],
            ['label' => 'QR temporales', 'path' => storage_path('app/public/tmp_qr')],
            ['label' => 'Vouchers de negociaciones', 'path' => storage_path('app/public/negotiations/vouchers')],
            ['label' => 'Backups de imagenes', 'path' => storage_path('app/performance-backups')],
            ['label' => 'Vistas compiladas', 'path' => storage_path('framework/views')],
        ],
    ],
];

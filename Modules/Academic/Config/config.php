<?php

return [
    'name' => 'Academic',

    'openai' => [
        'api_key' => env('API_KEY_IA', env('OPENAI_API_KEY')),
        // Parametro del sistema (tabla parameters) que contiene la API Key de OpenAI.
        'api_key_parameter' => env('OPENAI_API_KEY_PARAMETER', 'P000025'),
        'model' => env('OPENAI_MODEL', 'gpt-4.1-mini'),
        'instructions' => env('OPENAI_INSTRUCTIONS', 'Eres un contador y un experto en NIIF y NIA, responde la consulta. La respuesta debe combinar lenguaje técnico sencillo de entender, y tener la siguiente estructura:
Análisis - Desarrollo - Conclusiones y Recomendaciones
responde usando etiquetas html
Limitate a responder las consultas, y no ofrescas algo más para continuar.'),
        'timeout' => env('OPENAI_TIMEOUT', 60),
    ],
];

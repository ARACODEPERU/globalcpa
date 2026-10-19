<?php

return [
    'name' => 'Academic',

    'openai' => [
        'api_key' => env('API_KEY_IA', env('OPENAI_API_KEY')),
        // Parametros del sistema para OpenAI (tabla parameters).
        'api_key_parameter' => env('OPENAI_API_KEY_PARAMETER', 'IA-00003'),
        'legacy_api_key_parameter' => 'P000025',
        'agent_id_parameter' => env('OPENAI_AGENT_ID_PARAMETER', 'IA-00002'),
        'provider_parameter' => env('ACADEMIC_AI_PROVIDER_PARAMETER', 'IA-00001'),
        'agent_id' => env('OPENAI_AGENT_ID'),
        // Espera maxima del agente antes de responder con el modelo, en segundos.
        'agent_timeout' => (int) env('OPENAI_AGENT_TIMEOUT', 90),
        // Milisegundos entre consultas del estado de la sesion del agente.
        'agent_poll_interval_ms' => (int) env('OPENAI_AGENT_POLL_INTERVAL_MS', 1000),
        // Minutos que se conserva la sesion del agente para continuar el hilo.
        'agent_session_minutes' => (int) env('OPENAI_AGENT_SESSION_MINUTES', 720),
        'model' => env('OPENAI_MODEL', 'gpt-4.1-mini'),
        'instructions' => env('OPENAI_INSTRUCTIONS', 'Responde como docente de CPA Academy. Se claro, util y cuidadoso con datos personales.'),
        'timeout' => env('OPENAI_TIMEOUT', 60),
    ],

    // Credenciales de Gemini en la tabla parameters.
    'gemini' => [
        'api_key_parameter' => env('GEMINI_API_KEY_PARAMETER', 'IA-00004'),
        'api_key' => env('API_KEY_GEMINI'),
        // gemini-2.0-flash cerro el 1 de junio de 2026.
        'model' => env('GEMINI_MODEL', 'gemini-3.8-flash'),
        'timeout' => env('GEMINI_TIMEOUT', 60),
    ],

    /*
     * Notificaciones masivas de cursos (SMS via Vonage y WhatsApp por
     * Integrationhub) enviadas desde la pestana Notificaciones del Academico.
     */
    'notifications' => [
        // Milisegundos entre envios: evita saturar el servidor y las APIs externas.
        'interval_ms' => (int) env('ACA_NOTIFICATION_INTERVAL_MS', 280),

        // Codigo de pais por defecto cuando la persona no tiene pais registrado.
        'country_code' => env('ACA_DEFAULT_COUNTRY_CODE', '51'),

        'vonage' => [
            // Parametro del sistema (tabla parameters) con el API Secret de Vonage.
            'parameter' => env('VONAGE_PARAMETER', 'SC-00001'),
            /*
             * API Key del panel de Vonage (la pareja del API Secret que vive en
             * el parametro del sistema). Puede reemplazarse con VONAGE_API_KEY o
             * enviar "api_key:api_secret" dentro del propio parametro.
             */
            'api_key' => env('VONAGE_API_KEY', 'fbaaac02'),
            // Alternativa JWT: solo si se configura una aplicacion de Vonage.
            'application_id' => env('VONAGE_APPLICATION_ID'),
            // Remitente (from) aprobado en Vonage: numero o sender ID alfanumerico.
            'sender' => env('VONAGE_SENDER', 'Vonage APIs'),
            'timeout' => (int) env('VONAGE_TIMEOUT', 30),
            /*
             * Costo por SMS (USD) para numeros de Peru, que se muestra en el pie
             * de pagina de la pantalla de notificaciones. En otros paises la
             * tarifa varia segun el destino.
             */
            'sms_price_peru_usd' => (float) env('VONAGE_SMS_PRICE_PE', 0.23369),
        ],

        'whatsapp' => [
            // Clave del ID de flujo configurable en Plantillas / Flujos.
            'flow_key' => 'aca_course_notification',
            /*
             * Endpoint que crea (o actualiza) el contacto antes de iniciar el
             * flujo: sin contacto la API no arranca la conversacion.
             */
            'create_contact_endpoint' => 'create_contact',
            'endpoint' => 'Inicio_contacto_con_flow_id',
        ],
    ],
];

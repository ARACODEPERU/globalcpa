<?php

namespace Modules\Academic\Services;

use App\Models\Parameter;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use RuntimeException;
use Throwable;

class OpenAiAssistantService
{
    private const BASE_URL = 'https://api.openai.com/v1';

    // Espera maxima del agente (segundos) leida una sola vez por instancia.
    private ?int $agentWaitSeconds = null;

    /**
     * Responde una consulta con el agente guardado de OpenAI (Agents API).
     *
     * Si el agente no esta configurado, falla o no responde dentro del tiempo
     * permitido, se usa el modelo de 'academic.openai.model' para no dejar al
     * usuario sin respuesta. El resultado indica de donde salio el texto para
     * que la interfaz pueda avisar cuando se uso el modelo por defecto.
     *
     * @return array{text: string, source: string, agent_used: bool, notice: ?string, error: ?string}
     */
    public function sendPromptWithAgent(int|string $userId, string $message, ?string $customInstructions = null): array
    {
        if (trim($message) === '') {
            throw new RuntimeException('El mensaje para OpenAI no puede estar vacio.');
        }

        if ($this->configuredAgentId() === null) {
            return [
                'text' => $this->sendPrompt($userId, $message, null, $customInstructions),
                'source' => 'model',
                'agent_used' => false,
                'notice' => null,
                'error' => null,
            ];
        }

        try {
            $text = trim($this->requestAgent($userId, $message, $customInstructions));

            if ($text === '') {
                throw new RuntimeException('El agente no devolvio texto en su respuesta final.');
            }

            // El hilo del modelo no debe mezclarse con el del agente: si mas
            // adelante hay que caer al modelo, la respuesta empieza limpia.
            Cache::forget($this->responseCacheKey($userId));

            return [
                'text' => $text,
                'source' => 'agent',
                'agent_used' => true,
                'notice' => null,
                'error' => null,
            ];
        } catch (Throwable $exception) {
            // El agente es opcional: se registra el motivo real y se responde
            // con el modelo para conservar el funcionamiento del chat.
            Log::warning('Academic OpenAI agent fallback: ' . $exception->getMessage());
            Cache::forget($this->agentSessionCacheKey($userId));

            return [
                'text' => $this->sendPrompt($userId, $message, null, $customInstructions),
                'source' => 'model',
                'agent_used' => false,
                'notice' => 'Aviso: el Agente de OpenAI no respondió (espera máxima ' . $this->agentTimeoutLabel()
                    . '). Esta respuesta se generó con el modelo por defecto ' . $this->model() . '.',
                'error' => $exception->getMessage(),
            ];
        }
    }

    public function sendPrompt(int|string $userId, string $message, ?string $fileName = null, ?string $customInstructions = null, bool $continueThread = true): string
    {
        if (trim($message) === '') {
            throw new RuntimeException('El mensaje para OpenAI no puede estar vacio.');
        }

        $filePath = null;
        $input = [
            [
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'input_text',
                        'text' => $message,
                    ],
                ],
            ],
        ];

        // Usar instrucciones personalizadas si se proporcionan, sino usar las de config
        $instructions = $customInstructions ?? config('academic.openai.instructions');

        if ($fileName) {
            Cache::forget($this->responseCacheKey($userId));

            $filePath = $this->resolveFilePath($fileName);
            $input[0]['content'][] = [
                'type' => 'input_file',
                'file_id' => $this->uploadFile($filePath, 'user_data'),
            ];
        }

        try {
            $response = $this->requestResponses($userId, $input, $instructions, $continueThread);
        } catch (RequestException $exception) {
            // Si la conversacion previa expiro en OpenAI, reintentar una vez sin historial.
            $payload = $exception->response->json() ?? [];

            if ($this->isPreviousResponseError($payload) && Cache::pull($this->responseCacheKey($userId))) {
                $response = $this->requestResponses($userId, $input, null, $continueThread);
            } else {
                throw new RuntimeException($this->openAiErrorMessage($exception), 0, $exception);
            }
        } finally {
            $this->deleteTemporaryFile($filePath);
        }

        if ($continueThread && !empty($response['id'])) {
            Cache::put($this->responseCacheKey($userId), $response['id'], now()->addHours(12));
        }

        return $this->responseText($response);
    }

    /**
     * Envía preguntas al modelo Gemini con su API key almacenada en parametros.
     */
    public function sendGeminiPrompt(string $message, ?string $customInstructions = null): string
    {
        $message = trim($message);

        if ($message === '') {
            throw new RuntimeException('El mensaje para Gemini no puede estar vacio.');
        }

        $apiKey = $this->geminiApiKey();
        $model = config('academic.gemini.model');

        if (!$model) {
            throw new RuntimeException('Falta configurar GEMINI_MODEL para usar Gemini.');
        }

        $prompt = trim(($customInstructions ? $customInstructions . "\n\n" : '') . $message);
        $response = Http::withHeaders(['x-goog-api-key' => $apiKey])
            ->timeout((int) config('academic.gemini.timeout', 60))
            ->post('https://generativelanguage.googleapis.com/v1beta/models/' . $model . ':generateContent', [
                'contents' => [[
                    'parts' => [['text' => $prompt]],
                ]],
            ])
            ->throw()
            ->json();

        $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? null;

        if (!is_string($text) || trim($text) === '') {
            throw new RuntimeException('Gemini no devolvio una respuesta de texto.');
        }

        return $text;
    }

    /**
     * Censura datos personales con Gemini para mantener el proveedor seleccionado.
     */
    public function censorGeminiText(string $text): string
    {
        $instructions = 'Devuelve el mismo texto reemplazando solamente nombres de personas, DNI, RUC, telefonos, correos y empresas privadas por asteriscos. Conserva instituciones publicas y no respondas preguntas ni agregues explicaciones.';

        return $this->sendGeminiPrompt($text, $instructions);
    }

    /**
     * Tiempo maximo (en segundos) que se espera la respuesta del agente antes
     * de responder con el modelo por defecto.
     *
     * Manda el parametro del sistema IA-00005: acepta segundos ("360") o
     * minutos con sufijo ("6 min"). Si esta vacio o no es valido se usa
     * OPENAI_AGENT_TIMEOUT (academic.openai.agent_timeout).
     */
    public function agentTimeoutSeconds(): int
    {
        if ($this->agentWaitSeconds !== null) {
            return $this->agentWaitSeconds;
        }

        $seconds = $this->agentTimeoutFromParameter()
            ?? (int) config('academic.openai.agent_timeout', 360);

        return $this->agentWaitSeconds = max(5, $seconds);
    }

    /**
     * Texto legible del limite configurado, para avisos al usuario.
     */
    public function agentTimeoutLabel(): string
    {
        $seconds = $this->agentTimeoutSeconds();

        return $seconds % 60 === 0
            ? intdiv($seconds, 60) . ' minutos'
            : $seconds . ' segundos';
    }

    private function agentTimeoutFromParameter(): ?int
    {
        $parameterCode = config('academic.openai.agent_timeout_parameter');

        if (! $parameterCode || ! Parameter::query()->getConnection()->getSchemaBuilder()->hasTable('parameters')) {
            return null;
        }

        $value = trim((string) Parameter::where('parameter_code', $parameterCode)->value('value_default'));

        if ($value === '') {
            return null;
        }

        // "6 min", "6min", "6 minutos" se interpretan como minutos.
        if (preg_match('/^(\d+)\s*(m|min|mins|minuto|minutos)$/i', $value, $matches)) {
            return ((int) $matches[1]) * 60;
        }

        return is_numeric($value) ? (int) $value : null;
    }

    /**
     * Proveedor elegido en el parametro del sistema (1=OpenAI, 2=Gemini).
     */
    public function chatProvider(): string
    {
        $parameterCode = config('academic.openai.provider_parameter', 'IA-00001');
        $hasParameters = Parameter::query()->getConnection()->getSchemaBuilder()->hasTable('parameters');
        $value = null;

        if ($hasParameters) {
            $value = $parameterCode ? Parameter::where('parameter_code', $parameterCode)->value('value_default') : null;

            // Compatibilidad con el parametro anterior del proveedor.
            if (trim((string) $value) === '') {
                $value = Parameter::where('parameter_code', 'P000015')->value('value_default');
            }
        }

        return (int) trim((string) $value) === 2 ? 'gemini' : 'openai';
    }

    private function geminiApiKey(): string
    {
        $parameterCode = config('academic.gemini.api_key_parameter');
        $parameterValue = $parameterCode && Parameter::query()->getConnection()->getSchemaBuilder()->hasTable('parameters')
            ? Parameter::where('parameter_code', $parameterCode)->value('value_default')
            : null;
        $apiKey = trim((string) ($parameterValue ?: config('academic.gemini.api_key')));

        if ($apiKey === '') {
            throw new RuntimeException('Falta configurar la API Key de Gemini en el parametro IA-00004 del sistema.');
        }

        return $apiKey;
    }

    /**
     * Corrige la redaccion y ortografia (o solo la ortografia) de un texto.
     *
     * Devuelve unicamente el texto corregido: no altera nombres propios,
     * siglas, cifras ni el sentido del comentario.
     */
    public function correctText(int|string $userId, string $text, bool $onlySpelling = false): string
    {
        $rules = $onlySpelling
            ? 'Corrige UNICAMENTE la ortografia: tildes, puntuacion, mayusculas y concordancias basicas. NO reescribas las oraciones, NO cambies el orden de las ideas y NO reemplaces palabras por sinonimos.'
            : 'Corrige la redaccion y la ortografia: mejora la claridad, la puntuacion y la concordancia manteniendo el mismo sentido, el mismo tono y una extension similar.';

        $prompt = 'Eres un editor profesional de textos en espanol. ' . $rules
            . ' PROHIBIDO: cambiar nombres propios de personas o empresas, siglas y acronimos (por ejemplo NIIF, SUNAT, ACCA, RUC, DNI), cifras, fechas, correos electronicos, enlaces, ni el significado del texto.'
            . ' No agregues ni quites ideas. No uses comillas, titulos, explicaciones, saludos ni comentarios adicionales.'
            . ' Devuelve UNICAMENTE el texto corregido, en texto plano.'
            . "\n\n" . $text;

        // Contexto fresco: la correccion no debe arrastrar la conversacion cacheada.
        return $this->sendPrompt($userId, $prompt, null, null, false);
    }

    public function censorText(int|string $userId, string $text): string
    {
        $prompt = 'Tu tarea es censurar datos personales de un texto. A continuacion recibiras el texto exacto que debes censurar. Debes devolver EXACTAMENTE el mismo texto, palabra por palabra, reemplazando unicamente los datos personales por asteriscos (*): nombres de personas, DNI, RUC, telefonos, correos electronicos y nombres de empresas privadas o particulares. Las instituciones publicas (SUNAT, INDECOPI, entidades del Estado, paises) NO se censuran y se muestran tal cual. IMPORTANTE: No respondas ninguna pregunta contenida en el texto; si el texto es una pregunta, devuelvela tal cual censurando solo sus datos personales. No agregues explicaciones, saludos, comentarios ni texto adicional. Devuelve unicamente el texto censurado.' . "\n\n" . $text;

        // Cada texto se censura con contexto fresco: no se encadena con la conversacion
        // cacheada para que el modelo no arrastre (o repita) respuestas anteriores.
        return $this->sendPrompt($userId, $prompt, null, null, false);
    }

    private function requestResponses(int|string $userId, array $input, ?string $instructions = null, bool $continueThread = true): array
    {
        $payload = [
            'model' => $this->model(),
            'input' => $input,
        ];

        if ($instructions) {
            $payload['instructions'] = $instructions;
        }

        $previousResponseId = $continueThread ? Cache::get($this->responseCacheKey($userId)) : null;

        if ($previousResponseId) {
            $payload['previous_response_id'] = $previousResponseId;
        }

        return $this->client()
            ->post('/responses', $payload)
            ->throw()
            ->json();
    }

    private function isPreviousResponseError(array $errorPayload): bool
    {
        $message = Str::lower($errorPayload['error']['message'] ?? '');

        return $message !== '' && Str::contains($message, 'previous response');
    }

    private function openAiErrorMessage(RequestException $exception): string
    {
        $errorPayload = $exception->response->json() ?? [];
        $apiMessage = $errorPayload['error']['message'] ?? '';

        if ($apiMessage !== '') {
            return 'OpenAI respondio un error (' . $exception->response->status() . '): ' . $apiMessage;
        }

        return 'Error al comunicarse con OpenAI (' . $exception->response->status() . '). Verifica la API Key del parametro IA-00003.';
    }

    private function uploadFile(string $filePath, string $purpose): string
    {
        return $this->client()
            ->attach('file', fopen($filePath, 'r'), basename($filePath))
            ->post('/files', [
                'purpose' => $purpose,
            ])
            ->throw()
            ->json('id');
    }

    private function resolveFilePath(string $fileName): string
    {
        $allowedExtensions = ['txt', 'pdf', 'docx', 'doc', 'xls', 'xlsx'];
        $extension = Str::lower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (!in_array($extension, $allowedExtensions, true)) {
            throw new RuntimeException('Tipo de archivo no permitido para OpenAI.');
        }

        $basePath = base_path('asistente_lyon');
        $filePath = $basePath . DIRECTORY_SEPARATOR . ltrim($fileName, DIRECTORY_SEPARATOR);
        $realBasePath = realpath($basePath);
        $realFilePath = realpath($filePath);

        if (!$realBasePath || !$realFilePath || !Str::startsWith($realFilePath, $realBasePath)) {
            throw new RuntimeException('Archivo no encontrado o ruta invalida.');
        }

        return $realFilePath;
    }

    private function deleteTemporaryFile(?string $filePath): void
    {
        if ($filePath && is_file($filePath)) {
            @unlink($filePath);
        }
    }

    private function client(): PendingRequest
    {
        return Http::withToken($this->apiKey())
            ->baseUrl(self::BASE_URL)
            ->timeout((int) config('academic.openai.timeout', 60))
            ->retry(2, 300, function ($exception) {
                return $exception instanceof RequestException && $exception->response?->serverError();
            });
    }

    private function apiKey(): string
    {
        $apiKey = $this->apiKeyFromParameter();

        if (!$apiKey) {
            $apiKey = config('academic.openai.api_key');
        }

        if (!$apiKey) {
            throw new RuntimeException('Falta configurar la API Key de OpenAI en el parametro IA-00003 del sistema.');
        }

        return $this->sanitizeApiKey($apiKey);
    }

    /**
     * Limpia la key de caracteres invisibles o espacios que suelen quedar
     * al copiarla/pegarla (espacios, saltos de linea, zero-width, NBSP).
     */
    private function sanitizeApiKey(string $apiKey): string
    {
        $clean = preg_replace('/[\s\x{200B}-\x{200D}\x{FEFF}\x{00A0}]+/u', '', $apiKey) ?? '';

        return trim($clean);
    }

    protected function apiKeyFromParameter(): ?string
    {
        $parameterCode = config('academic.openai.api_key_parameter');

        if ($parameterCode && Parameter::query()->getConnection()->getSchemaBuilder()->hasTable('parameters')) {
            $value = Cache::remember(
                'academic:openai-api-key:' . $parameterCode,
                now()->addMinutes(60),
                function () use ($parameterCode) {
                    return Parameter::where('parameter_code', $parameterCode)->value('value_default');
                }
            );

            $value = trim((string) $value);

            if ($value !== '') {
                return $value;
            }
        }

        // Compatibilidad: P000025 fue usado anteriormente para la API Key, pero
        // tambien es un parametro de descuentos. Solo aceptar valores con forma
        // de clave OpenAI para nunca enviar por accidente el valor 1 o 2.
        $legacyCode = config('academic.openai.legacy_api_key_parameter');

        if ($legacyCode && $legacyCode !== $parameterCode && Parameter::query()->getConnection()->getSchemaBuilder()->hasTable('parameters')) {
            $legacyValue = trim((string) Parameter::where('parameter_code', $legacyCode)->value('value_default'));

            if (preg_match('/^sk-(?:proj-)?[A-Za-z0-9_-]+$/', $legacyValue)) {
                return $legacyValue;
            }
        }

        return null;
    }

    /**
     * ID del agente creado en la cuenta de OpenAI (formato agent_...).
     *
     * El parametro del sistema es la fuente principal: vaciarlo desactiva el
     * agente sin tocar el .env. 'agent_id' del .env solo se usa cuando la
     * aplicacion no tiene ningun codigo de parametro configurado (pruebas o
     * instalaciones que administran la IA fuera de la tabla parameters).
     */
    private function configuredAgentId(): ?string
    {
        $parameterCode = config('academic.openai.agent_id_parameter');
        $hasParameters = Parameter::query()->getConnection()->getSchemaBuilder()->hasTable('parameters');
        $agentId = null;

        if ($parameterCode && $hasParameters) {
            $agentId = trim((string) Parameter::where('parameter_code', $parameterCode)->value('value_default'));
        }

        if ($agentId === null || $agentId === '') {
            $agentId = (string) config('academic.openai.agent_id');
        }

        $agentId = $this->normalizeAgentId($agentId);

        return $agentId !== '' ? $agentId : null;
    }

    /**
     * @throws RuntimeException cuando el agente no esta configurado o su ID
     *                          no tiene el formato de la Agents API.
     */
    private function agentId(): string
    {
        $agentId = $this->configuredAgentId();

        if ($agentId === null) {
            $parameterCode = config('academic.openai.agent_id_parameter', 'IA-00002');
            throw new RuntimeException('Falta configurar el ID del agente de OpenAI en el parametro ' . $parameterCode . ' del sistema.');
        }

        if (!preg_match('/^agent_[A-Za-z0-9_-]+$/', $agentId)) {
            throw new RuntimeException('El ID del agente debe ser un agente guardado de la Agents API (empieza con agent_).');
        }

        return $agentId;
    }

    /**
     * Recorta espacios y comillas y, si se pego la URL del panel de OpenAI,
     * conserva solo el ID del agente.
     */
    private function normalizeAgentId(string $value): string
    {
        $value = trim($value);
        $value = trim(str_replace(['"', "'"], '', $value));

        if (preg_match('/^agent_[A-Za-z0-9_-]+$/', $value)) {
            return $value;
        }

        // URL del panel de OpenAI: .../agents/agent_XXXX
        if (preg_match('#/agents/(agent_[A-Za-z0-9_-]+)#', $value, $matches)) {
            return $matches[1];
        }

        return $value;
    }

    /**
     * Ejecuta una consulta contra el agente guardado usando una sesion por
     * usuario: la primera consulta crea la sesion y las siguientes reutilizan
     * el mismo hilo mientras la sesion siga activa.
     */
    private function requestAgent(int|string $userId, string $message, ?string $customInstructions = null): string
    {
        // La espera puede durar varios minutos: sin ampliar el limite, PHP
        // (php.ini suele traer 30-60 s) corta la peticion antes del tiempo
        // configurado y el usuario nunca recibe la respuesta del agente.
        $this->extendExecutionTime($this->agentTimeoutSeconds() + 120);

        $agentId = $this->agentId();
        $sessionKey = $this->agentSessionCacheKey($userId);
        $sessionId = Cache::get($sessionKey);
        $lastAnswerId = null;

        if ($sessionId) {
            if (!$this->agentSessionIsReusable($sessionId)) {
                // La sesion fallo o espera una accion que no podemos completar:
                // se descarta y se abre una nueva para esta consulta.
                Cache::forget($sessionKey);
                $sessionId = null;
            } else {
                // Se guarda la ultima respuesta para no confundirla con la nueva.
                $lastAnswer = $this->latestAgentAnswer($sessionId);
                $lastAnswerId = $lastAnswer['id'] ?? null;

                try {
                    $this->agentClient()
                        ->withHeaders(['Idempotency-Key' => (string) Str::uuid()])
                        ->post("/agents/sessions/{$sessionId}/events", [
                            'events' => [
                                [
                                    'type' => 'agent.session.input.message',
                                    'input' => $this->agentInput($message),
                                ],
                            ],
                        ])
                        ->throw();
                } catch (RequestException) {
                    // La sesion ya no acepta mensajes (cerrada o de otro usuario):
                    // se abre una nueva y el usuario no ve el error.
                    Cache::forget($sessionKey);
                    $sessionId = null;
                }
            }
        }

        if (!$sessionId) {
            $payload = [
                'agent_id' => $agentId,
                'environment' => ['type' => 'none'],
                'input' => $this->agentInput($message),
            ];

            // Con agent_id, estas instrucciones se agregan a las del agente
            // guardado; conservan el formato que ya usa el formulario.
            if (is_string($customInstructions) && trim($customInstructions) !== '') {
                $payload['agent'] = ['instructions' => $customInstructions];
            }

            $session = $this->agentClient()
                ->post('/agents/sessions', $payload)
                ->throw()
                ->json();

            $sessionId = $session['id'] ?? null;

            if (!$sessionId) {
                throw new RuntimeException('OpenAI no devolvio el ID de la sesion del agente.');
            }

            Cache::put($sessionKey, $sessionId, now()->addMinutes($this->agentSessionMinutes()));
        }

        return $this->waitForAgentAnswer($sessionId, $lastAnswerId);
    }

    /**
     * Espera a que la sesion produzca una respuesta final distinta de la
     * anterior. La Agents API trabaja de forma asincrona: se consulta el estado
     * y los items guardados en lugar de mantener abierta una conexion SSE.
     */
    private function waitForAgentAnswer(string $sessionId, ?string $previousAnswerId): string
    {
        $timeout = $this->agentTimeoutSeconds();
        $deadline = microtime(true) + $timeout;
        $intervalUs = max(200, (int) config('academic.openai.agent_poll_interval_ms', 1000)) * 1000;

        while (true) {
            $session = $this->agentClient()
                ->get("/agents/sessions/{$sessionId}")
                ->throw()
                ->json();

            $status = $session['status'] ?? null;

            if ($status === 'failed') {
                throw new RuntimeException('La sesion del agente fallo: ' . (string) ($session['error'] ?? 'sin detalle'));
            }

            $answer = $this->latestAgentAnswer($sessionId, $previousAnswerId);

            if ($answer !== null && $answer['text'] !== '') {
                return $answer['text'];
            }

            if ($status === 'requires_action') {
                throw new RuntimeException('El agente quedo esperando una accion que el sistema no puede completar.');
            }

            if (microtime(true) >= $deadline) {
                throw new RuntimeException('El agente no respondio dentro del tiempo configurado (' . $timeout . ' s).');
            }

            usleep($intervalUs);
        }
    }

    /**
     * Devuelve el ultimo mensaje final del agente, ignorando la respuesta que
     * ya existia antes de enviar la consulta actual.
     *
     * @return array{id: ?string, text: string}|null
     */
    private function latestAgentAnswer(string $sessionId, ?string $previousAnswerId = null): ?array
    {
        $items = $this->agentClient()
            ->get("/agents/sessions/{$sessionId}/items", ['order' => 'desc', 'limit' => 20])
            ->throw()
            ->json('data') ?? [];

        foreach ($items as $item) {
            if (($item['type'] ?? null) !== 'message'
                || ($item['role'] ?? null) !== 'assistant'
                || ($item['phase'] ?? null) !== 'final_answer'
                || ($item['status'] ?? null) !== 'completed') {
                continue;
            }

            $itemId = $item['id'] ?? null;

            if ($itemId !== null && $itemId === $previousAnswerId) {
                return null;
            }

            $text = collect($item['content'] ?? [])
                ->filter(fn ($content) => ($content['type'] ?? null) === 'output_text')
                ->pluck('text')
                ->implode('');

            return ['id' => $itemId, 'text' => trim((string) $text)];
        }

        return null;
    }

    /**
     * Una sesion terminada queda en 'in_progress' aunque su respuesta ya este
     * completa, asi que se reutiliza salvo que haya fallado o espere una accion
     * que el sistema no puede resolver.
     */
    private function agentSessionIsReusable(string $sessionId): bool
    {
        try {
            $session = $this->agentClient()
                ->get("/agents/sessions/{$sessionId}")
                ->throw()
                ->json();

            $status = $session['status'] ?? null;

            return !in_array($status, ['failed', 'requires_action'], true);
        } catch (RequestException) {
            // La sesion ya no existe o no se puede consultar: se crea otra.
            return false;
        }
    }

    /**
     * @return array<int, array{role: string, content: array<int, array{type: string, text: string}>}>
     */
    private function agentInput(string $message): array
    {
        return [
            [
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'input_text',
                        'text' => $message,
                    ],
                ],
            ],
        ];
    }

    private function agentClient(): PendingRequest
    {
        // Cada peticion individual (crear sesion, consultar estado o items) es
        // corta; la espera total la controla el bucle de waitForAgentAnswer.
        return Http::withToken($this->apiKey())
            ->baseUrl(self::BASE_URL)
            ->withHeaders(['OpenAI-Beta' => 'agents=v1'])
            ->timeout(60)
            ->connectTimeout(10);
    }

    /**
     * Sube el limite de ejecucion de PHP para que la espera del agente quepa
     * dentro de la peticion HTTP (php.ini suele traer 30-60 s).
     */
    private function extendExecutionTime(int $seconds): void
    {
        if (function_exists('set_time_limit')) {
            @set_time_limit($seconds);
        }
    }

    private function agentSessionMinutes(): int
    {
        return max(1, (int) config('academic.openai.agent_session_minutes', 720));
    }

    private function agentSessionCacheKey(int|string $userId): string
    {
        return 'academic:openai-agent-session:' . $userId;
    }

    private function responseText(array $response): string
    {
        if (!empty($response['output_text'])) {
            return $response['output_text'];
        }

        foreach ($response['output'] ?? [] as $output) {
            foreach ($output['content'] ?? [] as $content) {
                if (($content['type'] ?? null) === 'output_text') {
                    return $content['text'] ?? '';
                }
            }
        }

        throw new RuntimeException('OpenAI no devolvio una respuesta de texto.');
    }

    private function model(): string
    {
        $model = config('academic.openai.model');

        if (!$model) {
            throw new RuntimeException('Falta configurar OPENAI_MODEL para usar OpenAI.');
        }

        return $model;
    }

    private function responseCacheKey(int|string $userId): string
    {
        return 'academic:openai-response:' . $userId;
    }
}

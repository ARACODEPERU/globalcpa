<?php

namespace Tests\Unit\Modules\Academic\Services;

use App\Models\Parameter;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Schema;
use Modules\Academic\Services\OpenAiAssistantService;
use RuntimeException;
use Tests\TestCase;

class OpenAiAgentsServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Cache::flush();

        if (!Schema::hasTable('parameters')) {
            Schema::create('parameters', function ($table) {
                $table->id();
                $table->string('parameter_code')->unique();
                $table->string('description');
                $table->char('control_type', 3)->nullable();
                $table->text('json_query_data')->nullable();
                $table->text('value_default')->nullable();
                $table->timestamps();
            });
        }

        config([
            'academic.openai.api_key' => 'sk-test-key',
            'academic.openai.api_key_parameter' => null,
            'academic.openai.agent_id_parameter' => null,
            'academic.openai.agent_id' => 'agent_test_123',
            'academic.openai.agent_timeout' => 5,
            'academic.openai.agent_poll_interval_ms' => 200,
            'academic.openai.agent_session_minutes' => 60,
            'academic.openai.model' => 'gpt-4.1-mini',
            'academic.gemini.api_key' => 'gemini-test-key',
            'academic.gemini.api_key_parameter' => null,
            'academic.gemini.model' => 'gemini-test-model',
        ]);
    }

    protected function tearDown(): void
    {
        Cache::flush();
        parent::tearDown();
    }

    public function test_creates_agent_session_and_returns_the_final_answer(): void
    {
        Http::fake([
            'api.openai.com/v1/agents/sessions' => Http::response(['id' => 'sess_1']),
            'api.openai.com/v1/agents/sessions/sess_1/items*' => Http::response([
                'data' => [$this->finalAnswer('msg_1', 'Respuesta del agente')],
            ]),
            'api.openai.com/v1/agents/sessions/sess_1' => Http::response(['status' => 'idle']),
        ]);

        $result = app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Pregunta del alumno', 'Instrucciones docentes');

        $this->assertSame('Respuesta del agente', $result['text']);
        $this->assertTrue($result['agent_used']);
        $this->assertSame('agent', $result['source']);
        $this->assertNull($result['notice']);
        $this->assertSame('sess_1', Cache::get('academic:openai-agent-session:7'));

        Http::assertSent(function ($request) {
            return str_ends_with($request->url(), '/v1/agents/sessions')
                && $request->method() === 'POST'
                && $request->header('Authorization')[0] === 'Bearer sk-test-key'
                && $request->header('OpenAI-Beta')[0] === 'agents=v1'
                && $request['agent_id'] === 'agent_test_123'
                && $request['environment']['type'] === 'none'
                && $request['input'][0]['content'][0]['text'] === 'Pregunta del alumno'
                && $request['agent']['instructions'] === 'Instrucciones docentes';
        });
    }

    public function test_reuses_the_agent_session_for_the_next_question(): void
    {
        Http::fake([
            'api.openai.com/v1/agents/sessions' => Http::response(['id' => 'sess_1']),
            'api.openai.com/v1/agents/sessions/sess_1/events' => Http::response([]),
            'api.openai.com/v1/agents/sessions/sess_1/items*' => Http::sequence()
                ->push(['data' => [$this->finalAnswer('msg_1', 'Primera respuesta')]])
                ->push(['data' => [$this->finalAnswer('msg_1', 'Primera respuesta')]])
                ->push(['data' => [
                    $this->finalAnswer('msg_2', 'Segunda respuesta'),
                    $this->finalAnswer('msg_1', 'Primera respuesta'),
                ]]),
            // La API deja la sesion en 'in_progress' aunque ya termino el turno.
            'api.openai.com/v1/agents/sessions/sess_1' => Http::response(['status' => 'in_progress']),
        ]);

        $service = app(OpenAiAssistantService::class);

        $this->assertSame('Primera respuesta', $service->sendPromptWithAgent(7, 'Pregunta 1')['text']);
        $this->assertSame('Segunda respuesta', $service->sendPromptWithAgent(7, 'Pregunta 2')['text']);

        Http::assertSent(function ($request) {
            return str_ends_with($request->url(), '/agents/sessions/sess_1/events')
                && $request->method() === 'POST'
                && $request['events'][0]['type'] === 'agent.session.input.message'
                && $request['events'][0]['input'][0]['content'][0]['text'] === 'Pregunta 2';
        });
    }

    public function test_creates_a_new_agent_session_when_the_old_one_rejects_the_message(): void
    {
        Cache::put('academic:openai-agent-session:7', 'sess_1', now()->addHour());

        Http::fake([
            'api.openai.com/v1/agents/sessions/sess_1/events' => Http::response(['error' => ['message' => 'session closed']], 400),
            'api.openai.com/v1/agents/sessions/sess_1/items*' => Http::response([
                'data' => [$this->finalAnswer('msg_1', 'Respuesta anterior')],
            ]),
            'api.openai.com/v1/agents/sessions/sess_1' => Http::response(['status' => 'in_progress']),
            'api.openai.com/v1/agents/sessions' => Http::response(['id' => 'sess_2']),
            'api.openai.com/v1/agents/sessions/sess_2/items*' => Http::response([
                'data' => [$this->finalAnswer('msg_2', 'Respuesta nueva')],
            ]),
            'api.openai.com/v1/agents/sessions/sess_2' => Http::response(['status' => 'in_progress']),
        ]);

        $result = app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Otra pregunta');

        $this->assertSame('Respuesta nueva', $result['text']);
        $this->assertTrue($result['agent_used']);
        $this->assertSame('sess_2', Cache::get('academic:openai-agent-session:7'));
    }

    public function test_reads_agent_id_from_its_system_parameter(): void
    {
        config(['academic.openai.agent_id_parameter' => 'IA-00002']);
        Parameter::create([
            'parameter_code' => 'IA-00002',
            'description' => 'OpenAI agent id for test',
            'control_type' => 'tx',
            'json_query_data' => null,
            'value_default' => 'agent_abc123def456',
        ]);

        Http::fake([
            'api.openai.com/v1/agents/sessions' => Http::response(['id' => 'sess_1']),
            'api.openai.com/v1/agents/sessions/sess_1/items*' => Http::response([
                'data' => [$this->finalAnswer('msg_1', 'OK')],
            ]),
            'api.openai.com/v1/agents/sessions/sess_1' => Http::response(['status' => 'idle']),
        ]);

        app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Pregunta');

        Http::assertSent(fn ($request) => str_ends_with($request->url(), '/agents/sessions')
            && $request['agent_id'] === 'agent_abc123def456');
    }

    public function test_accepts_agent_id_pasted_with_the_panel_url(): void
    {
        config(['academic.openai.agent_id' => 'https://platform.openai.com/agents/agent_abc123def456?tab=logs']);

        Http::fake([
            'api.openai.com/v1/agents/sessions' => Http::response(['id' => 'sess_1']),
            'api.openai.com/v1/agents/sessions/sess_1/items*' => Http::response([
                'data' => [$this->finalAnswer('msg_1', 'OK')],
            ]),
            'api.openai.com/v1/agents/sessions/sess_1' => Http::response(['status' => 'idle']),
        ]);

        app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Pregunta');

        Http::assertSent(fn ($request) => str_ends_with($request->url(), '/agents/sessions')
            && $request['agent_id'] === 'agent_abc123def456');
    }

    public function test_uses_the_model_when_no_agent_is_configured(): void
    {
        config(['academic.openai.agent_id' => '']);

        Http::fake([
            'api.openai.com/v1/responses' => Http::response(['output_text' => 'Respuesta del modelo']),
        ]);

        $result = app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Pregunta');

        $this->assertSame('Respuesta del modelo', $result['text']);
        $this->assertFalse($result['agent_used']);
        $this->assertSame('model', $result['source']);
        $this->assertNull($result['notice']);
        Http::assertNotSent(fn ($request) => str_contains($request->url(), '/agents/'));
    }

    public function test_falls_back_to_the_model_when_the_agent_fails(): void
    {
        Http::fake([
            'api.openai.com/v1/agents/sessions' => Http::response(['error' => ['message' => 'agent not found']], 404),
            'api.openai.com/v1/responses' => Http::response(['output_text' => 'Respuesta del modelo']),
        ]);

        $result = app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Pregunta');

        $this->assertSame('Respuesta del modelo', $result['text']);
        $this->assertFalse($result['agent_used']);
        $this->assertSame('model', $result['source']);
        $this->assertStringContainsString('Agente de OpenAI no respondió', $result['notice']);
    }

    public function test_warns_when_the_agent_id_has_the_wrong_format(): void
    {
        config(['academic.openai.agent_id' => 'asst_abc123']);

        Http::fake([
            'api.openai.com/v1/responses' => Http::response(['output_text' => 'Respuesta del modelo']),
        ]);

        $result = app(OpenAiAssistantService::class)->sendPromptWithAgent(7, 'Pregunta');

        $this->assertFalse($result['agent_used']);
        $this->assertStringContainsString('empieza con agent_', $result['error']);
        Http::assertNotSent(fn ($request) => str_contains($request->url(), '/agents/'));
    }

    public function test_sends_gemini_prompt_using_server_side_api_key(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/v1beta/models/gemini-test-model:generateContent' => Http::response([
                'candidates' => [[
                    'content' => ['parts' => [['text' => '<p>Respuesta Gemini</p>']]],
                ]],
            ]),
        ]);

        $answer = app(OpenAiAssistantService::class)->sendGeminiPrompt('Pregunta del alumno', 'Instrucciones');

        $this->assertSame('<p>Respuesta Gemini</p>', $answer);

        Http::assertSent(function ($request) {
            return $request->header('x-goog-api-key')[0] === 'gemini-test-key'
                && $request['contents'][0]['parts'][0]['text'] === "Instrucciones\n\nPregunta del alumno";
        });
    }

    public function test_gemini_reads_its_api_key_from_its_system_parameter(): void
    {
        config(['academic.gemini.api_key_parameter' => 'IA-00004']);
        Parameter::create([
            'parameter_code' => 'IA-00004',
            'description' => 'Gemini API key for test',
            'control_type' => 'tx',
            'json_query_data' => null,
            'value_default' => 'parameter-gemini-key',
        ]);

        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [['content' => ['parts' => [['text' => 'OK']]]]],
            ]),
        ]);

        app(OpenAiAssistantService::class)->sendGeminiPrompt('Pregunta');

        Http::assertSent(fn ($request) => $request->header('x-goog-api-key')[0] === 'parameter-gemini-key');
    }

    public function test_provider_comes_from_its_system_parameter(): void
    {
        $service = app(OpenAiAssistantService::class);

        $this->assertSame('openai', $service->chatProvider());

        Parameter::create([
            'parameter_code' => 'IA-00001',
            'description' => 'AI provider for test',
            'control_type' => 'tx',
            'json_query_data' => null,
            'value_default' => '2',
        ]);

        $this->assertSame('gemini', $service->chatProvider());
    }

    public function test_provider_falls_back_to_the_legacy_parameter(): void
    {
        Parameter::create([
            'parameter_code' => 'P000015',
            'description' => 'Legacy AI provider for test',
            'control_type' => 'tx',
            'json_query_data' => null,
            'value_default' => '2',
        ]);

        $this->assertSame('gemini', app(OpenAiAssistantService::class)->chatProvider());
    }

    /**
     * @return array<string, mixed>
     */
    private function finalAnswer(string $id, string $text): array
    {
        return [
            'id' => $id,
            'type' => 'message',
            'role' => 'assistant',
            'phase' => 'final_answer',
            'status' => 'completed',
            'content' => [
                ['type' => 'output_text', 'text' => $text],
            ],
        ];
    }
}

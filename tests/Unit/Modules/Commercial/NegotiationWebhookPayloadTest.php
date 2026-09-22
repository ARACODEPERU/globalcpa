<?php

namespace Tests\Unit\Modules\Commercial;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Commercial\Entities\CommercialNegotiation;
use Modules\Commercial\Entities\CommercialNegotiationItem;
use Tests\TestCase;

/**
 * El paso final del proceso de aprobacion envia el JSON de la negociacion a n8n
 * (endpoint n8n_post_negociacion). Si el payload cambia de forma sin que nadie lo
 * sepa, n8n recibe basura en silencio: aqui se fija el contrato de los campos que
 * el equipo acaba de pedir (creador/aprobador con id+email, profesion de la persona
 * y cuotas numeradas con su fecha de vencimiento).
 *
 * No toca MySQL: usa las tablas minimas que el payload consulta realmente sobre
 * el sqlite en memoria de phpunit.
 */
class NegotiationWebhookPayloadTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // La config cacheada del proyecto apunta a MySQL (que puede no estar
        // levantado): el payload solo consulta tres tablas, asi que se fuerza el
        // sqlite en memoria del entorno de pruebas sin tocar el default global.
        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
        ]);
        DB::purge('sqlite');

        if (! Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('email');
                $table->unsignedBigInteger('person_id')->nullable();
            });
        }

        if (! Schema::hasTable('aca_students')) {
            Schema::create('aca_students', function (Blueprint $table) {
                $table->increments('id');
                $table->string('student_code')->nullable();
                $table->unsignedBigInteger('person_id')->nullable();
            });
        }

        if (! Schema::hasTable('professions')) {
            Schema::create('professions', function (Blueprint $table) {
                $table->unsignedSmallInteger('id')->primary();
                $table->string('description');
            });
        }

        DB::table('professions')->insert([
            ['id' => 10, 'description' => 'Contabilidad'],
        ]);

        // Usuario del alumno (lo que payload() resuelve por person_id).
        DB::table('users')->insert([
            ['id' => 50, 'name' => 'Juan Perez', 'email' => 'juan@alumno.com', 'person_id' => 9],
        ]);
    }

    public function test_el_creador_y_el_aprobador_viajan_con_nombre_id_y_email(): void
    {
        $payload = $this->payload($this->negotiation());

        $this->assertSame('Ana Asesora', $payload['negociacion']['creado_por']);
        $this->assertSame(11, $payload['negociacion']['creado_por_id']);
        $this->assertSame('ana@globalcpa.com', $payload['negociacion']['creado_por_email']);

        $this->assertSame('Beto Revisor', $payload['negociacion']['aprobado_por']);
        $this->assertSame(12, $payload['negociacion']['aprobado_por_id']);
        $this->assertSame('beto@globalcpa.com', $payload['negociacion']['aprobado_por_email']);
    }

    public function test_sin_aprobador_los_campos_nuevos_son_null_y_no_tumban_el_payload(): void
    {
        $negotiation = $this->negotiation();
        $negotiation->setRelation('verifier', null);

        $payload = $this->payload($negotiation);

        $this->assertNull($payload['negociacion']['aprobado_por']);
        $this->assertNull($payload['negociacion']['aprobado_por_id']);
        $this->assertNull($payload['negociacion']['aprobado_por_email']);
    }

    public function test_la_profesion_de_la_persona_se_resuelve_desde_el_catalogo(): void
    {
        $payload = $this->payload($this->negotiation(), $this->person());

        $this->assertSame(10, $payload['persona']['profesion_id']);
        $this->assertSame('Contabilidad', $payload['persona']['profesion']);
        $this->assertSame('Contador publico', $payload['persona']['profesion_texto']);
    }

    public function test_sin_profesion_registrada_viaja_null(): void
    {
        $person = $this->person();
        $person->profession_id = null;
        $person->profession = null;

        $payload = $this->payload($this->negotiation(), $person);

        $this->assertNull($payload['persona']['profesion_id']);
        $this->assertNull($payload['persona']['profesion']);
        $this->assertNull($payload['persona']['profesion_texto']);
    }

    public function test_las_cuotas_viajan_numeradas_con_su_fecha_de_vencimiento_y_monto(): void
    {
        $negotiation = $this->negotiation();
        $negotiation->schedule = [
            ['due_date' => '2026-10-01', 'amount' => '400.00'],
            ['due_date' => '2026-11-01', 'amount' => '400.00'],
            ['due_date' => '2026-12-01', 'amount' => '400.00'],
        ];

        $cuotas = $this->payload($negotiation)['negociacion']['cuotas'];

        $this->assertCount(3, $cuotas);
        $this->assertSame([1, 2, 3], array_column($cuotas, 'numero'));
        $this->assertSame(
            ['2026-10-01', '2026-11-01', '2026-12-01'],
            array_column($cuotas, 'due_date'),
            'Cada cuota debe conservar su fecha de vencimiento: es lo que n8n usa para recordar el pago.'
        );
        $this->assertSame([400.0, 400.0, 400.0], array_column($cuotas, 'amount'));
    }

    public function test_en_pago_unico_las_cuotas_viajan_vacias(): void
    {
        $negotiation = $this->negotiation();
        $negotiation->payment_type = 'single';
        $negotiation->schedule = null;

        $cuotas = $this->payload($negotiation)['negociacion']['cuotas'];

        $this->assertSame([], $cuotas);
    }

    /**
     * Invoca el metodo privado del controlador con una negociacion y persona en
     * memoria: las relaciones ya cargadas evitan cualquier consulta y las tablas
     * minimas creadas en setUp cubren las tres busquedas que si consulta.
     */
    private function payload(CommercialNegotiation $negotiation, ?Person $person = null): array
    {
        $controller = new \Modules\Commercial\Http\Controllers\CommercialNegotiationProcessController();

        $method = new \ReflectionMethod($controller, 'webhookPayload');
        $method->setAccessible(true);

        return $method->invoke($controller, $negotiation, $person ?? $this->person());
    }

    private function negotiation(): CommercialNegotiation
    {
        $negotiation = new CommercialNegotiation([
            'title' => 'Paquete CPA 2026',
            'total_price' => 1200,
            'currency' => 'PEN',
            'payment_type' => 'installments',
            'schedule' => [['due_date' => '2026-10-01', 'amount' => '1200.00']],
            'status' => 'confirmada',
        ]);

        $negotiation->id = 7;

        $creator = new User(['name' => 'Ana Asesora', 'email' => 'ana@globalcpa.com']);
        $creator->id = 11;

        $verifier = new User(['name' => 'Beto Revisor', 'email' => 'beto@globalcpa.com']);
        $verifier->id = 12;

        $negotiation->setRelation('creator', $creator);
        $negotiation->setRelation('verifier', $verifier);
        $negotiation->setRelation('invoice', null);
        $negotiation->setRelation('items', collect([
            new CommercialNegotiationItem(['title' => 'Curso de Auditoria', 'price' => 1200]),
        ]));

        return $negotiation;
    }

    private function person(): Person
    {
        $person = new Person([
            'full_name' => 'Juan Perez',
            'number' => '12345678',
            'document_type_id' => 1,
            'email' => 'juan@globalcpa.com',
            'profession' => 'Contador publico',
        ]);

        $person->id = 9;
        $person->profession_id = 10;

        return $person;
    }
}

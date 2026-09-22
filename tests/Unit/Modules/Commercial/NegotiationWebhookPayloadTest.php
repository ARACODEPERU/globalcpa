<?php

namespace Tests\Unit\Modules\Commercial;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Commercial\Entities\CommercialNegotiation;
use Modules\Commercial\Entities\CommercialNegotiationItem;
use Modules\Commercial\Support\NegotiationWebhookPayload;
use Tests\TestCase;

/**
 * El paso final del proceso de aprobacion envia el JSON de la negociacion a n8n
 * (endpoint n8n_post_negociacion). Si el payload cambia de forma sin que nadie lo
 * sepa, n8n recibe basura en silencio: aqui se fija el contrato de los campos que
 * el equipo acaba de pedir (creador/aprobador con id+email, carrera del alumno,
 * profesion declarada de la persona y cuotas numeradas con su fecha de vencimiento).
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

        // El controlador marca aqui al aprobador cuando el paso de webhook corre
        // antes de que el usuario pulse "Finalizar".
        if (! Schema::hasTable('commercial_negotiations')) {
            Schema::create('commercial_negotiations', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('verified_by')->nullable();
                $table->timestamp('verified_at')->nullable();
                $table->timestamps();
            });
        }

        // Matriculas del alumno: de aqui sale su carrera (solo nivel programa).
        if (! Schema::hasTable('aca_courses')) {
            Schema::create('aca_courses', function (Blueprint $table) {
                $table->increments('id');
                $table->string('description')->nullable();
                $table->string('type_description')->nullable();
            });
        }

        if (! Schema::hasTable('aca_cap_registrations')) {
            Schema::create('aca_cap_registrations', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedBigInteger('student_id');
                $table->unsignedBigInteger('course_id');
            });
        }

        // Usuario del alumno (lo que payload() resuelve por person_id).
        DB::table('users')->insert([
            ['id' => 50, 'name' => 'Juan Perez', 'email' => 'juan@alumno.com', 'person_id' => 9],
        ]);

        DB::table('aca_students')->insert([
            ['id' => 77, 'student_code' => '43106435', 'person_id' => 9],
        ]);

        DB::table('aca_courses')->insert([
            ['id' => 1, 'description' => 'PROGRAMA NIIF ACCA', 'type_description' => 'Programas de Especialización'],
            ['id' => 2, 'description' => 'ESPECIALIZACION EN AUDITORIA', 'type_description' => 'Programas de Especialización'],
            ['id' => 3, 'description' => 'CURSO TALLER DE EXCEL', 'type_description' => 'Cursos Taller'],
        ]);

        DB::table('aca_cap_registrations')->insert([
            ['id' => 1, 'student_id' => 77, 'course_id' => 1],
            ['id' => 2, 'student_id' => 77, 'course_id' => 2],
            ['id' => 3, 'student_id' => 77, 'course_id' => 3],
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

    public function test_el_paso_de_webhook_registra_al_administrador_que_aprueba(): void
    {
        $id = DB::table('commercial_negotiations')->insertGetId([
            'verified_by' => null,
            'verified_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAsUser(12);
        $this->registerApprover(CommercialNegotiation::find($id));

        $row = DB::table('commercial_negotiations')->where('id', $id)->first();

        $this->assertSame(12, (int) $row->verified_by, 'El aprobador no puede viajar en null al JSON de n8n.');
        $this->assertNotNull($row->verified_at);
    }

    public function test_no_pisa_al_aprobador_registrado_desde_el_detalle(): void
    {
        $id = DB::table('commercial_negotiations')->insertGetId([
            'verified_by' => 11,
            'verified_at' => '2026-09-01 10:00:00',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAsUser(12);
        $this->registerApprover(CommercialNegotiation::find($id));

        $row = DB::table('commercial_negotiations')->where('id', $id)->first();

        $this->assertSame(11, (int) $row->verified_by);
        $this->assertSame('2026-09-01 10:00:00', $row->verified_at);
    }

    public function test_la_carrera_del_alumno_lleva_sus_programas_y_deja_fuera_los_talleres(): void
    {
        $estudiante = $this->payload($this->negotiation())['estudiante'];

        $this->assertSame(77, (int) $estudiante['id']);
        $this->assertSame(
            ['PROGRAMA NIIF ACCA', 'ESPECIALIZACION EN AUDITORIA'],
            $estudiante['carrera'],
            'La carrera son los estudios de nivel programa; el curso taller no es carrera.'
        );
    }

    public function test_un_alumno_sin_programas_viaja_sin_carrera_y_su_ficha_queda_en_persona(): void
    {
        DB::table('aca_cap_registrations')->whereIn('course_id', [1, 2])->delete();

        $person = $this->person();
        $person->ocupacion = 'Jefe de tesoreria';

        $payload = $this->payload($this->negotiation(), $person);

        $this->assertSame([], $payload['estudiante']['carrera']);
        $this->assertSame('Jefe de tesoreria', $payload['persona']['ocupacion'], 'Lo declarado en la ficha viaja en persona, no como carrera.');
    }

    public function test_sin_ficha_de_alumno_la_carrera_viaja_vacia(): void
    {
        DB::table('aca_students')->where('person_id', 9)->delete();

        $person = $this->person();
        $person->ocupacion = 'Contador independiente';

        $payload = $this->payload($this->negotiation(), $person);

        $this->assertNull($payload['estudiante']['id']);
        $this->assertSame([], $payload['estudiante']['carrera']);
        $this->assertSame('Contador independiente', $payload['persona']['ocupacion']);
    }

    public function test_los_tres_campos_de_profesion_llevan_el_cargo_de_la_negociacion(): void
    {
        // Sin datos del formulario en la negociacion, el cargo de la ficha es lo unico que
        // hay: la ficha rellena, pero no define el contrato de los tres campos de profesion.
        $person = $this->person();
        $person->ocupacion = 'Jefe de tesoreria';
        $person->occupation_id = 17;

        $persona = $this->payload($this->negotiation(), $person)['persona'];

        $this->assertSame(17, $persona['profesion_id']);
        $this->assertSame('Jefe de tesoreria', $persona['profesion']);
        $this->assertSame('Jefe de tesoreria', $persona['profesion_texto']);
    }

    public function test_sin_profesion_la_persona_viaja_con_el_cargo_que_declaro(): void
    {
        $person = $this->person();
        $person->profession_id = null;
        $person->profession = null;
        $person->ocupacion = 'Jefe de tesoreria';
        $person->occupation_id = 17;

        $payload = $this->payload($this->negotiation(), $person)['persona'];

        $this->assertSame(17, $payload['profesion_id']);
        $this->assertSame('Jefe de tesoreria', $payload['profesion']);
        $this->assertSame('Jefe de tesoreria', $payload['profesion_texto']);
        $this->assertSame('Jefe de tesoreria', $payload['ocupacion']);
    }

    public function test_sin_datos_en_la_ficha_se_usa_lo_capturado_en_la_negociacion(): void
    {
        $person = $this->person();
        $person->profession_id = null;
        $person->profession = null;
        $person->ocupacion = null;
        $person->occupation_id = null;
        $person->company = null;
        $person->industry = null;
        $person->industry_id = null;

        $negotiation = $this->negotiation();
        $negotiation->client_data = [
            'ocupacion' => 'Asistente administrativo',
            'occupation_id' => 4,
            'company' => 'Aracode',
            'industry' => 'Alquiler de Maquinarias',
            'industry_id' => 23,
        ];

        $payload = $this->payload($negotiation, $person)['persona'];

        $this->assertSame('Asistente administrativo', $payload['ocupacion']);
        $this->assertSame(4, $payload['ocupacion_id']);
        $this->assertSame(4, $payload['profesion_id']);
        $this->assertSame('Asistente administrativo', $payload['profesion']);
        $this->assertSame('Asistente administrativo', $payload['profesion_texto']);
        $this->assertSame('Aracode', $payload['empresa']);
        $this->assertSame('Alquiler de Maquinarias', $payload['industria']);
        $this->assertSame(23, $payload['industria_id']);
    }

    public function test_lo_declarado_en_la_negociacion_manda_sobre_la_ficha(): void
    {
        // El cliente declaro su cargo en el formulario y su ficha cambio despues (edito su
        // perfil, otra negociacion): a n8n viaja el cargo de esta negociacion, no el nuevo.
        $person = $this->person();
        $person->ocupacion = 'Gerente general';
        $person->occupation_id = 20;
        $person->company = 'EMPRESA DE LA FICHA';
        $person->industry = 'Construccion';
        $person->industry_id = 30;

        $negotiation = $this->negotiation();
        $negotiation->client_data = [
            'ocupacion' => 'Asistente administrativo',
            'occupation_id' => 4,
            'company' => 'Aracode',
            'industry' => 'Alquiler de Maquinarias',
            'industry_id' => 23,
        ];

        $payload = $this->payload($negotiation, $person)['persona'];

        $this->assertSame(4, $payload['profesion_id']);
        $this->assertSame('Asistente administrativo', $payload['profesion']);
        $this->assertSame('Asistente administrativo', $payload['profesion_texto']);
        $this->assertSame('Asistente administrativo', $payload['ocupacion']);
        $this->assertSame(4, $payload['ocupacion_id']);
        $this->assertSame('Aracode', $payload['empresa']);
        $this->assertSame('Alquiler de Maquinarias', $payload['industria']);
        $this->assertSame(23, $payload['industria_id']);
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

    private function actingAsUser(int $id): void
    {
        $user = new User(['name' => 'Admin QA', 'email' => 'admin.qa@globalcpa.com']);
        $user->id = $id;

        $this->actingAs($user);
    }

    private function registerApprover(CommercialNegotiation $negotiation): void
    {
        $controller = new \Modules\Commercial\Http\Controllers\CommercialNegotiationProcessController();

        $method = new \ReflectionMethod($controller, 'registerApprover');
        $method->setAccessible(true);

        $method->invoke($controller, $negotiation);
    }

    /**
     * Arma el payload con una negociacion y persona en memoria: las relaciones ya
     * cargadas evitan cualquier consulta y las tablas minimas creadas en setUp
     * cubren las busquedas que si consulta.
     */
    private function payload(CommercialNegotiation $negotiation, ?Person $person = null): array
    {
        return NegotiationWebhookPayload::forNegotiation($negotiation, $person ?? $this->person());
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

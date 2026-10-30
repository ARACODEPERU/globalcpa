<?php

namespace Tests\Unit\Modules\Commercial;

use App\Models\Person;
use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Commercial\Http\Controllers\CommercialNegotiationProcessController;
use Tests\TestCase;

class CommercialNegotiationUserStepTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'database.connections.sqlite.foreign_key_constraints' => false,
        ]);
        DB::purge('sqlite');

        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->string('short_name')->nullable();
            $table->string('full_name')->nullable();
            $table->string('names')->nullable();
            $table->string('father_lastname')->nullable();
            $table->string('mother_lastname')->nullable();
            $table->unsignedBigInteger('document_type_id')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->unsignedBigInteger('person_id')->nullable();
            $table->unsignedBigInteger('local_id')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        Schema::create('commercial_negotiations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->string('status');
            $table->string('payment_type');
            $table->decimal('total_price', 12, 2)->nullable();
            $table->string('email')->nullable();
            $table->json('schedule')->nullable();
            $table->json('client_data')->nullable();
            $table->json('process_progress')->nullable();
            $table->timestamps();
        });

        Schema::create('commercial_negotiation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('negotiation_id');
            $table->string('item_type');
            $table->unsignedBigInteger('item_id');
            $table->decimal('price', 12, 2)->nullable();
            $table->timestamps();
        });

        Schema::create('commercial_negotiation_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('negotiation_id');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
        });

        DB::table('roles')->insert(['id' => 1, 'name' => 'Alumno', 'guard_name' => 'web']);

        $admin = new User;
        $admin->id = 99;
        $admin->local_id = 1;
        $this->actingAs($admin);
    }

    public function test_el_paso_usuario_deja_la_persona_y_el_usuario_registrados(): void
    {
        $person = Person::create([
            'document_type_id' => 1,
            'number' => '71399390',
            'short_name' => 'Alexis',
            'names' => 'Alexis',
            'full_name' => 'Maquera Soncco Alexis',
            'email' => 'alexis@example.com',
        ]);

        $negotiationId = DB::table('commercial_negotiations')->insertGetId([
            'client_id' => $person->id,
            'status' => 'confirmada',
            'payment_type' => 'single',
            'total_price' => 875,
            'client_data' => json_encode([
                'document_type_id' => 1,
                'number' => '71399390',
                'names' => 'Alexis Bryan',
                'father_lastname' => 'Maquera',
                'mother_lastname' => 'Soncco',
                'full_name' => 'Maquera Soncco Alexis Bryan',
                'email' => 'nuevo@example.com',
                'telephone' => '5195860353',
            ]),
            'process_progress' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = app(CommercialNegotiationProcessController::class)
            ->processUser(Request::create('/', 'POST'), $negotiationId);

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue($response->getData()->success);

        $this->assertSame(1, User::where('person_id', $person->id)->count());
        $user = User::where('person_id', $person->id)->first();
        $this->assertSame('Maquera Soncco Alexis Bryan', $user->name);
        $this->assertSame('nuevo@example.com', $user->email);
        $this->assertSame(1, DB::table('model_has_roles')->count());

        $person->refresh();
        $this->assertSame('Alexis Bryan', $person->names);
        $this->assertSame('nuevo@example.com', $person->email);
        $this->assertSame('5195860353', $person->telephone);
    }

    public function test_el_paso_usuario_completa_el_registro_si_el_usuario_quedo_suelto(): void
    {
        $person = Person::create([
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $looseUser = User::create([
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $negotiationId = DB::table('commercial_negotiations')->insertGetId([
            'client_id' => $person->id,
            'status' => 'confirmada',
            'payment_type' => 'single',
            'total_price' => 875,
            'client_data' => json_encode(['email' => 'alexis@example.com']),
            'process_progress' => json_encode([]),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        app(CommercialNegotiationProcessController::class)
            ->processUser(Request::create('/', 'POST'), $negotiationId);

        $this->assertSame(1, User::count());
        $this->assertSame($person->id, (int) $looseUser->fresh()->person_id);
    }
}

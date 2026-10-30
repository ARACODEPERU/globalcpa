<?php

namespace Tests\Unit\Support;

use App\Models\Person;
use App\Models\User;
use App\Support\PersonRegistrationGuard;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PersonRegistrationGuardTest extends TestCase
{
    private PersonRegistrationGuard $guard;

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
            $table->string('gender')->nullable();
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

        $this->guard = app(PersonRegistrationGuard::class);
    }

    public function test_crea_el_usuario_que_falto_al_final_del_registro(): void
    {
        $person = Person::create([
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis',
            'father_lastname' => 'Maquera',
            'mother_lastname' => 'Soncco',
            'email' => 'alexis@example.com',
        ]);

        $this->assertSame(0, User::count());

        $result = $this->guard->ensure($person, [
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis',
            'email' => 'alexis@example.com',
        ], [
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $this->assertTrue($result['created_user']);
        $this->assertFalse($result['created_person']);
        $this->assertSame(1, User::count());
        $this->assertSame($person->id, (int) $result['user']->person_id);
        $this->assertSame('alexis@example.com', $result['user']->email);
        $this->assertNotEmpty($result['user']->password);
    }

    public function test_refresca_persona_y_usuario_con_los_datos_recientes(): void
    {
        $person = Person::create([
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Nombre Viejo',
            'email' => 'viejo@example.com',
            'telephone' => '000000',
        ]);

        $user = User::create([
            'name' => 'Nombre Viejo',
            'email' => 'viejo@example.com',
            'person_id' => $person->id,
        ]);

        $result = $this->guard->ensure($person, [
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis Bryan',
            'father_lastname' => 'Maquera',
            'mother_lastname' => 'Soncco',
            'email' => 'nuevo@example.com',
            'telephone' => '5195860353',
        ], [
            'name' => 'Alexis Bryan',
            'email' => 'nuevo@example.com',
        ], $user);

        $this->assertFalse($result['created_person']);
        $this->assertFalse($result['created_user']);
        $this->assertContains('names', $result['updated_fields']);
        $this->assertContains('email', $result['updated_fields']);

        $person->refresh();
        $this->assertSame('Alexis Bryan', $person->names);
        $this->assertSame('5195860353', $person->telephone);
        $this->assertSame('nuevo@example.com', $person->email);

        $user->refresh();
        $this->assertSame('Alexis Bryan', $user->name);
        $this->assertSame('nuevo@example.com', $user->email);
        $this->assertSame(1, User::count());
    }

    public function test_vincula_un_usuario_existente_que_estaba_suelto(): void
    {
        $person = Person::create([
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $user = User::create([
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $this->assertNull($user->person_id);

        $result = $this->guard->ensure($person, [], [], $user);

        $this->assertSame($person->id, (int) $result['user']->person_id);
        $this->assertSame(1, User::count());
    }

    public function test_crea_la_persona_faltante_y_la_vincula_al_usuario_existente(): void
    {
        User::create([
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $result = $this->guard->ensure(null, [
            'document_type_id' => 1,
            'number' => '71399390',
            'short_name' => 'Alexis',
            'names' => 'Alexis',
            'father_lastname' => 'Maquera',
            'email' => 'alexis@example.com',
        ], [
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $this->assertTrue($result['created_person']);
        $this->assertSame(1, Person::count());
        $this->assertSame(1, User::count());
        $this->assertSame($result['person']->id, (int) $result['user']->person_id);
    }

    public function test_no_duplica_cuando_la_persona_ya_esta_completa(): void
    {
        $person = Person::create([
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis',
            'email' => 'alexis@example.com',
        ]);

        $user = User::create([
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
            'person_id' => $person->id,
        ]);

        $result = $this->guard->ensure($person, [
            'document_type_id' => 1,
            'number' => '71399390',
            'names' => 'Alexis',
            'email' => 'alexis@example.com',
        ], [
            'name' => 'Alexis',
            'email' => 'alexis@example.com',
        ], $user);

        $this->assertFalse($result['created_person']);
        $this->assertFalse($result['created_user']);
        $this->assertSame([], $result['updated_fields']);
        $this->assertSame(1, Person::count());
        $this->assertSame(1, User::count());
    }
}

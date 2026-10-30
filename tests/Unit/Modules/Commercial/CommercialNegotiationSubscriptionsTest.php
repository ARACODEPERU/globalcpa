<?php

namespace Tests\Unit\Modules\Commercial;

use App\Models\User;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Commercial\Http\Controllers\CommercialNegotiationProcessController;
use Tests\TestCase;

class CommercialNegotiationSubscriptionsTest extends TestCase
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
        });

        Schema::create('aca_students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('person_id');
        });

        Schema::create('commercial_negotiations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('client_id');
            $table->string('status');
            $table->string('payment_type');
            $table->json('schedule')->nullable();
            $table->json('process_progress')->nullable();
            $table->timestamps();
        });

        Schema::create('commercial_negotiation_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('negotiation_id');
            $table->string('item_type');
            $table->unsignedBigInteger('item_id');
            $table->decimal('price', 12, 2)->nullable();
            $table->string('entity_name_product')->nullable();
            $table->string('title')->nullable();
            $table->timestamps();
        });

        Schema::create('commercial_negotiation_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('negotiation_id');
        });

        Schema::create('aca_subscription_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('period')->nullable();
            $table->json('prices')->nullable();
        });

        Schema::create('aca_student_subscriptions', function (Blueprint $table) {
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subscription_id');
            $table->date('date_start')->nullable();
            $table->date('date_end')->nullable();
            $table->boolean('status')->default(true);
            $table->text('notes')->nullable();
            $table->integer('renewals')->default(0);
            $table->unsignedBigInteger('registration_user_id')->nullable();
            $table->decimal('amount_paid', 12, 2)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->primary(['student_id', 'subscription_id']);
        });

        DB::table('people')->insert(['id' => 10]);
        DB::table('aca_students')->insert(['id' => 20, 'person_id' => 10]);
        DB::table('aca_subscription_types')->insert([
            'id' => 30,
            'period' => 'Mensual',
            'prices' => json_encode([
                ['currency' => 'PEN', 'amount' => 125.50],
                ['currency' => 'USD', 'amount' => 35],
            ]),
        ]);

        DB::table('commercial_negotiations')->insert([
            'id' => 40,
            'client_id' => 10,
            'status' => 'confirmada',
            'payment_type' => 'single',
            'schedule' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('commercial_negotiation_items')->insert([
            'id' => 50,
            'negotiation_id' => 40,
            'item_type' => 'subscription',
            'item_id' => 30,
            'price' => 0,
        ]);

        $this->travelTo(now()->setDate(2026, 10, 29)->startOfDay());

        $user = new User();
        $user->id = 99;
        $this->actingAs($user);
    }

    public function test_actualiza_suscripcion_existente_usando_las_dos_columnas_de_su_clave_compuesta(): void
    {
        DB::table('aca_student_subscriptions')->insert([
            'student_id' => 20,
            'subscription_id' => 30,
            'date_start' => '2020-01-01',
            'date_end' => '2020-02-01',
            'status' => false,
            'notes' => 'Registro previo',
            'renewals' => 3,
            'amount_paid' => 10,
            'created_at' => now()->subYear(),
            'updated_at' => now()->subYear(),
        ]);

        $response = $this->processSubscriptions();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue($response->getData()->success);
        $this->assertSame(1, DB::table('aca_student_subscriptions')->count());

        $subscription = DB::table('aca_student_subscriptions')->first();
        $this->assertSame('1', (string) $subscription->status);
        $this->assertNull($subscription->notes);
        $this->assertSame(0, (int) $subscription->renewals);
        $this->assertSame(99, (int) $subscription->registration_user_id);
        $this->assertSame(125.5, (float) $subscription->amount_paid);
        $this->assertSame(now()->toDateString(), $subscription->date_start);
        $this->assertSame(now()->addMonth()->toDateString(), $subscription->date_end);
    }

    public function test_inserta_suscripcion_nueva_y_lee_el_precio_desde_el_array_casteado(): void
    {
        $response = $this->processSubscriptions();

        $this->assertSame(200, $response->getStatusCode());
        $this->assertTrue($response->getData()->success);
        $this->assertSame(1, DB::table('aca_student_subscriptions')->count());

        // Volver a ejecutar el paso debe actualizar el mismo registro, no duplicarlo.
        $retryResponse = $this->processSubscriptions();
        $this->assertSame(200, $retryResponse->getStatusCode());
        $this->assertSame(1, DB::table('aca_student_subscriptions')->count());

        $subscription = DB::table('aca_student_subscriptions')->first();
        $this->assertSame(20, (int) $subscription->student_id);
        $this->assertSame(30, (int) $subscription->subscription_id);
        $this->assertSame(125.5, (float) $subscription->amount_paid);
    }

    private function processSubscriptions()
    {
        return app(CommercialNegotiationProcessController::class)
            ->processSubscriptions(Request::create('/', 'POST'), 40);
    }
}

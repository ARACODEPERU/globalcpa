<?php

use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $country = Country::firstOrCreate(
        ['description' => 'Perú'],
        ['status' => true]
    );

    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '+51 999 888 777',
        'country_id' => $country->id,
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);

    $user = User::where('email', 'test@example.com')->first();

    expect($user->phone)->toBe('+51 999 888 777');
    expect($user->country_id)->toBe($country->id);
});

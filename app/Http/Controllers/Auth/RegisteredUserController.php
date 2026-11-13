<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Integrationhub\Jobs\SendRegisteredUserToIntegrationhub;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('Auth/Register', [
            'countries' => Country::where('status', true)
                ->orderBy('description')
                ->get(['id', 'description']),
            // Título del artículo del blog desde el que se llegó al registro.
            // Se convierte en el producto `blog-{curso}` del payload a n8n.
            'blog_curso' => (string) $request->query('blog_curso', ''),
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'country_id' => $validated['country_id'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        // El registro ya está persistido: se avisa a Integrationhub con todos
        // los datos del usuario. Si la integración no está configurada o el
        // servicio externo falla, el registro NO se rompe: el job lo registra
        // en la bitácora del módulo (integration_errors).
        try {
            SendRegisteredUserToIntegrationhub::dispatch($user->id, $validated['blog_curso'] ?? null);
        } catch (\Throwable $e) {
            report($e);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}

<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Any visitor can register.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas del registro: datos de la cuenta + teléfono y país.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:30', 'regex:/^\+?[0-9\s\-()]{6,30}$/'],
            'country_id' => ['required', 'integer', 'exists:countries,id'],
            // Artículo del blog desde el que se registró: identifica el producto
            // `blog-{curso}` que se envía a n8n. Es opcional.
            'blog_curso' => ['nullable', 'string', 'max:255'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'phone.regex' => 'Ingresa un número de teléfono válido (solo números, espacios, +, - y paréntesis).',
            'country_id.exists' => 'El país seleccionado no es válido.',
        ];
    }
}

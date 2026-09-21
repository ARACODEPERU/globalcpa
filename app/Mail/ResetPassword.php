<?php

namespace App\Mail;

use App\Support\MailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Password;

class ResetPassword extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public mixed $user;
    public string $url;
    public int $tries = 3;
    public array $backoff = [60, 300];

    public function __construct(mixed $user)
    {
        $this->user = $user;

        // El token se crea una sola vez, antes de encolar. No debe regenerarse en
        // build()/content(), porque un reintento produciría otro enlace.
        $token = Password::createToken($user);
        $this->url = route('password.reset', $token);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(MailSender::address(), MailSender::name()),
            subject: 'Restablecer contraseña - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset_password',
            with: [
                'url' => $this->url,
                'user' => $this->user,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

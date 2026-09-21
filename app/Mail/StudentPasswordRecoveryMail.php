<?php

namespace App\Mail;

use App\Models\Person;
use App\Support\MailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentPasswordRecoveryMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [60, 300];

    public Person $person;
    public string $resetUrl;

    public function __construct(Person $person, string $resetUrl)
    {
        $this->person = $person;
        $this->resetUrl = $resetUrl;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                MailSender::address(),
                MailSender::name()
            ),
            subject: 'Recuperar contraseña - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.student_password_recovery',
            with: [
                'person' => $this->person,
                'resetUrl' => $this->resetUrl,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

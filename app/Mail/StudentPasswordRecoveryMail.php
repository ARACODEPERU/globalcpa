<?php

namespace App\Mail;

use App\Models\Person;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentPasswordRecoveryMail extends Mailable
{
    use Queueable, SerializesModels;

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
                env('MAIL_FROM_ADDRESS', 'informes@globalcpaperu.com'),
                env('MAIL_FROM_NAME', 'CPA Academy')
            ),
            subject: 'Recuperar contraseña - ' . env('APP_NAME', 'CPA Academy'),
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

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Support\MailSender;

class SendClaimConfirmationEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public int $tries = 3;
    public array $backoff = [60, 300];

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                MailSender::address(),
                MailSender::name()
            ),
            subject: 'Confirmación de Recepción de Reclamo - Folio: ' . $this->data->composite_code,
        );
    }

    public function build()
    {
        return $this->view('emails.claim_confirmation', [
            'data' => $this->data
        ]);
    }

    public function attachments(): array
    {
        return [];
    }
}

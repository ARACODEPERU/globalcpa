<?php

namespace App\Mail;

use App\Support\MailSender;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Modules\Commercial\Entities\CommercialNegotiation;

class CommercialNegotiationConfirmedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $negotiation;
    public $client;

    /**
     * Enlace al proceso de 9 pasos: es el "siguiente paso" que el equipo debe
     * continuar, tanto el asesor como los administradores que reciben el aviso.
     * Al ser propiedad publica, la vista la tiene disponible como $processUrl.
     */
    public $processUrl;

    public function __construct(CommercialNegotiation $negotiation, $client)
    {
        $this->negotiation = $negotiation;
        $this->client = $client;
        $this->processUrl = $this->resolveProcessUrl($negotiation);
    }

    /**
     * Si el nombre de ruta no esta publicado (por ejemplo con una cache de rutas
     * anterior a habilitar el modulo) route() lanza y el correo no saldria: se cae
     * a la URL canonica, que es la misma que registra el modulo.
     */
    private function resolveProcessUrl(CommercialNegotiation $negotiation): string
    {
        try {
            return route('comm_negotiations_process', $negotiation->id);
        } catch (\Throwable $e) {
            return url('/commercial/negotiations/process/' . $negotiation->id);
        }
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                MailSender::address('contacto@globalcpa.com'),
                MailSender::name()
            ),
            subject: 'Negociacion confirmada por el cliente - ' . config('app.name'),
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'commercial::emails.commercial-negotiation-confirmed',
            with: [
                'negotiation' => $this->negotiation,
                'client' => $this->client,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

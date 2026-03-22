<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationRequested extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Crear una nueva instancia del mensaje.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Obtener el sobre del mensaje (clase Envelope).
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva Solicitud de Reserva - La Casilla',
        );
    }

    /**
     * Obtener la definición del contenido del mensaje.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.reservations.requested',
        );
    }

    /**
     * Obtener los adjuntos del mensaje.
     */
    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Reservation $reservation) {}

    public function envelope(): Envelope
    {
        $status = match($this->reservation->status) {
            'accepted' => '✅ Réservation acceptée',
            'refused'  => '❌ Réservation refusée',
            'cancelled' => '🚫 Réservation annulée',
            default    => 'Mise à jour de votre réservation',
        };

        return new Envelope(
            subject: $status . ' - ' . $this->reservation->annonce->titre,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation-status-changed',
        );
    }
}
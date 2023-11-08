<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Alta de cliente";
    public $client;
    public $random;

    public function __construct($client,$random)
    {
        $this->client = $client;
        $this->random = $random;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

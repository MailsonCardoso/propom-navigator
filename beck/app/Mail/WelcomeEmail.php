<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;
    public $userCpf;
    public $userPassword;
    public $amountPaid;

    /**
     * Create a new message instance.
     */
    public function __construct($userName, $userCpf, $userPassword, $amountPaid = 100.00)
    {
        $this->userName = $userName;
        $this->userCpf = $userCpf;
        $this->userPassword = $userPassword;
        $this->amountPaid = $amountPaid;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Acesso Liberado - PREPOM Navigator 2026',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.welcome',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

<?php

namespace App\Mail;

use App\Models\InclusiveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InclusiveApplicationApproved extends Mailable
{
    use Queueable, SerializesModels;

    public InclusiveApplication $application;
    public string $tempPassword;
    public string $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(InclusiveApplication $application, string $tempPassword)
    {
        $this->application = $application;
        $this->tempPassword = $tempPassword;
        $this->loginUrl = url('/login');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Selamat! Permohonan Inclusive Program Anda Disetujui - EtalaseKu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.inclusive-approved',
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

<?php

namespace App\Mail;

use App\Models\InclusiveApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InclusiveApplicationRejected extends Mailable
{
    use Queueable, SerializesModels;

    public InclusiveApplication $application;
    public string $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(InclusiveApplication $application)
    {
        $this->application = $application;
        $this->loginUrl = url('/inclusive-program');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Update Permohonan Inclusive Program - EtalaseKu',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.inclusive-rejected',
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

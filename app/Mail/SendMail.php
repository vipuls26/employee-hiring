<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Application $application,
        public string $stage,
        public string $action,
        public ?string $reason,
        public string $reviewerName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Application Update: ' . $this->stage . ' ' . $this->action,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.application-decision',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}

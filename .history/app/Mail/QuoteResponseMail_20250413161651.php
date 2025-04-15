<?php

namespace App\Mail;

use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuoteResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public QuoteRequest $quoteRequest,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $companyName = config('app.name', 'Modern Sentra');

        $subject = match ($this->quoteRequest->response_status) {
            'accepted' => "Penawaran Anda Disetujui - {$companyName}",
            'rejected' => "Tanggapan Penawaran - {$companyName}",
            'negotiation' => "Negosiasi Penawaran - {$companyName}",
            default => "Tanggapan Permintaan Penawaran - {$companyName}",
        };

        return new Envelope(
            subject: $subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class ExceptionMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $htmlContent;

    /**
     * Create a new message instance.
     *
     * @param string $htmlContent
     * @return void
     */
    public function __construct(string $htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: config('developerMail.subject-exception')
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.exception', // Adjusted to the correct view path
            with: ['htmlContent' => $this->htmlContent]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

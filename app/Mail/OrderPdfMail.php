<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderPdfMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $filePath;
    public $file;
    public $order;

    public function __construct($filePath, $file, $order)
    {
        $this->filePath = $filePath;
        $this->file = $file;
        $this->order = $order;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'LegalPdf Downloadable PDF File.',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        // Language PDF Direction 
        $direction = "ltr"; // default direction
        $language = \App\Models\Language::where('code', $this->order->language)->first(); // Retrieve the language model
        if ($language && ($language->direction)) {
            $direction = $language->direction;
        }

        return new Content(
            view: 'web.mail.pdf_mail',
            with: ['direction' => $direction]
        );
    }


    public function build()
    {
        return $this->view('web.mail.pdf_mail')->subject(localize( 'order_pdf_mail_subject' ) );
    }
}

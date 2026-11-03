<?php

namespace App\Mail;

use App\Models\Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailForUserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $config = Config::where('is_applicable', true)->first();
        return new Envelope(
            subject:  __('PROGRAMME DE FIDELITE LOFOMBO DE ') . $config->enterprise_name . ' – ' . __("Enregistrement à la plateforme de fidélité de") . ' ' . $this->data['enterprise'],
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mailtemplates.emailtemplates.user-registered',
            with: ['data' => $this->data],
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

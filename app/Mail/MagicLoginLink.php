<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class MagicLoginLink extends Mailable
{
    use Queueable, SerializesModels;

    public $plaintextToken;
    public $expiresAt;

    /**
     * Create a new message instance.
     */
    public function __construct($plaintextToken, $expiresAt)
    {
      $this->plaintextToken = $plaintextToken;
      $this->expiresAt = $expiresAt;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: config('app.name') . ' Magic Login Link',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.magic-login-link',
            with: [
                'url' =>  URL::temporarySignedRoute('user.verify-login', $this->expiresAt, [
                    'token' => $this->plaintextToken,
                ]),
            ],
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

    // public function build()
    // {
    //   return $this->subject(
    //     config('app.name') . ' Login Verification'
    //   )->markdown('emails.magic-login-link', [
    //     'url' => URL::temporarySignedRoute('verify-login', $this->expiresAt, [
    //       'token' => $this->plaintextToken,
    //     ]),
    //   ]);
    // }
}

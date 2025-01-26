<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class PasswordReset extends Mailable
{
    use Queueable, SerializesModels;

    

    /**
     * Create a new message instance.
     *
     * @param
     */
    public function __construct($resetLink)
{
    $this->resetLink = $resetLink;
}

public function build()
{
    return $this->subject('Reset Your Password')
                ->view('emails.forgotpassword')
                ->with(['resetLink' => $this->resetLink]);
}

}
<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventDeletedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $event;

    /**
     * Create a new message instance.
     *
     * @param  \App\Models\Event  $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Your Event Has Been Canceled')
                    ->view('emails.event_deleted');
    }
}

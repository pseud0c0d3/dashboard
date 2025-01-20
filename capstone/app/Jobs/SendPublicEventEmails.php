<?php

namespace App\Jobs;

use App\Models\Event;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventCreated;
use App\Mail\EventUpdatedMail;
use App\Mail\EventDeletedMail;
use Illuminate\Support\Facades\Log;

class SendPublicEventEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $event;
    public $emailType;

    /**
     * Create a new job instance.
     *
     * @param Event $event
     * @param string $emailType
     */
    public function __construct(Event $event, string $emailType)
    {
        $this->event = $event;
        $this->emailType = $emailType;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
{
    // Fetch all users with valid emails in chunks of 50
    User::whereNotNull('email')
        ->chunk(10, function ($users) {
            foreach ($users as $user) {
                if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                    continue; // Skip invalid emails
                }

                switch ($this->emailType) {
                    case 'created':
                        Mail::to($user->email)->send(new EventCreated($this->event));
                        break;
                    case 'updated':
                        Mail::to($user->email)->send(new EventUpdatedMail($this->event));
                        break;
                    case 'deleted':
                        Mail::to($user->email)->send(new EventDeletedMail($this->event));
                        break;
                }
            }
        });
    
}

}

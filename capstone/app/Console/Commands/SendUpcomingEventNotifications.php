<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Mail\EventUpcomingNotification;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendUpcomingEventNotifications extends Command
{
    protected $signature = 'events:notify-upcoming';

    protected $description = 'Send email notifications for events happening tomorrow.';

    public function handle()
    {
        $tomorrow = Carbon::now()->addDay()->startOfDay();

        // Query events scheduled for tomorrow
        $events = Event::whereDate('start_time', $tomorrow)->get();


        foreach ($events as $event) {
            // Send email notification to the user
            Mail::to($event->user->email)->send(new EventUpcomingNotification($event));

            $this->info("Notification sent to {$event->user->email} for event ID: {$event->id}");
        }

        return Command::SUCCESS;
    }
}


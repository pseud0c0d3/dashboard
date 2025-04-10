<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\User;
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

        if ($events->isEmpty()) {
            $this->warn('No events found for tomorrow.');
            return Command::FAILURE;
        }

        foreach ($events as $event) {
            if ($event->is_public) {
                // Handle public events: send emails to all users
                $users = User::whereNotNull('email')->get(); // Fetch users with valid emails
                
                foreach ($users as $user) {
                    if (!filter_var($user->email, FILTER_VALIDATE_EMAIL)) {
                        $this->warn("Invalid email for user ID: {$user->id}");
                        continue;
                    }

                    try {
                        Mail::to($user->email)->send(new EventUpcomingNotification($event));
                        $this->info("Public event notification sent to {$user->email} for event ID: {$event->id}");
                    } catch (\Exception $e) {
                        $this->error("Failed to send email to {$user->email}: {$e->getMessage()}");
                    }
                }
            } else {
                // Handle private events: send email to the associated user
                if (!$event->user) {
                    $this->warn("Event ID: {$event->id} has no associated user.");
                    continue;
                }

                if (!filter_var($event->user->email, FILTER_VALIDATE_EMAIL)) {
                    $this->warn("Invalid email for user associated with event ID: {$event->id}");
                    continue;
                }

                try {
                    Mail::to($event->user->email)->send(new EventUpcomingNotification($event));
                    $this->info("Private event notification sent to {$event->user->email} for event ID: {$event->id}");
                } catch (\Exception $e) {
                    $this->error("Failed to send email to {$event->user->email}: {$e->getMessage()}");
                }
            }
        }

        return Command::SUCCESS;
    }
}

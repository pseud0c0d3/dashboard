<?php

namespace App\Console\Commands;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule the 'notify-upcoming' command to run daily at 8 AM
        $schedule->command('events:notify-upcoming')->dailyAt('08:00');

        // Schedule the 'hide-old' command to run daily
        $schedule->command('posts:hide-old')->daily();
    }

    // Register the commands
    protected $commands = [
        \App\Console\Commands\NotifyUpcomingEvents::class,
        \App\Console\Commands\HideOldPosts::class, // Add the new command to the array
    ];
}

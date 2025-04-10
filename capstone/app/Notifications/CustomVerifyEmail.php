<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class CustomVerifyEmail extends Notification
{
    /**
     * Determine the channels through which the notification should be sent.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // This ensures the notification is sent via email
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Create the email verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify', // Name of the route
            Carbon::now()->addMinutes(60), // Expiry time of the link
            ['id' => $notifiable->getKey(), 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return (new MailMessage)
            ->line('Please click the button below to verify your email address.')
            ->action('Verify Email', $verificationUrl) // Add the verification URL as a button
            ->line('If you did not create an account, no further action is required.');
    }
}


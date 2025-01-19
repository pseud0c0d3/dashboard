<?php

// app/Notifications/EventUpdatedOrDeleted.php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventUpdatedOrDeleted extends Notification
{
    use Queueable;

    protected $event;
    protected $action;

    /**
     * Create a new notification instance.
     *
     * @param $event
     * @param string $action
     * @return void
     */
    public function __construct($event, $action)
    {
        $this->event = $event;
        $this->action = $action;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $event = $this->event;
        $action = $this->action;

        return (new MailMessage)
                    ->greeting('Hello,')
                    ->line('The following event has been ' . $action . ':')
                    ->line('Title: ' . $event->title)
                    ->line('Description: ' . $event->description)
                    ->line('Start Time: ' . $event->start_time->format('Y-m-d H:i'))
                    ->line('End Time: ' . $event->end_time->format('Y-m-d H:i'))
                    ->action('View Event', url('/events/' . $event->id))
                    ->line('Thank you for using our application!');
    }
}

// namespace App\Notifications;

// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Notifications\Messages\MailMessage;
// use Illuminate\Notifications\Notification;

// class EventUpdatedOrDeleted extends Notification
// {
//     use Queueable;

//     /**
//      * Create a new notification instance.
//      */
//     public function __construct()
//     {
//         //
//     }

//     /**
//      * Get the notification's delivery channels.
//      *
//      * @return array<int, string>
//      */
//     public function via(object $notifiable): array
//     {
//         return ['mail'];
//     }

//     /**
//      * Get the mail representation of the notification.
//      */
//     public function toMail(object $notifiable): MailMessage
//     {
//         return (new MailMessage)
//                     ->line('The introduction to the notification.')
//                     ->action('Notification Action', url('/'))
//                     ->line('Thank you for using our application!');
//     }

//     /**
//      * Get the array representation of the notification.
//      *
//      * @return array<string, mixed>
//      */
//     public function toArray(object $notifiable): array
//     {
//         return [
//             //
//         ];
//     }
// }

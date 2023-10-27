<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationEmailNotification extends Notification
{
    use Queueable;

    public $query;

    /**
     * Create a new notification instance.
     */
    public function __construct($query)
    {
        $this->query = $query;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = env('FRONT_URL', 'http://localhost:3000') . "?$this->query";
        return (new MailMessage)
                    ->subject('Verify Email')
                    ->greeting('Hello')
                    ->line('Click the button below to verify your email address.')
                    ->action('Verify Email Address', url($url))
                    ->line('If you did not create an account, no further action is required.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

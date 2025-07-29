<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class WelcomeNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('Welcome to Karibu Jikoni!')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Thank you for joining Karibu Jikoni.');

        if ($notifiable->is_admin) {
            $message->line('As an admin, you have access to manage the platform.');
        } else {
            $message->line('Enjoy our delicious meals as a valued customer.');
        }

        $message->action('Log In', url('/login'))
                ->line('If you have any questions, contact us at support@karibu.com.')
                ->salutation('Warm regards, Karibu Jikoni Team');

        return $message;
    }
}
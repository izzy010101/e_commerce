<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailVerifiedNotification extends Notification
{
    use Queueable;

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Email Verified Successfully')
            ->line('Congratulations! Your email has been successfully verified.')
            ->action('Go to Dashboard', url('/dashboard'))
            ->line('Thank you for verifying your email. You can now access all features of your account.');
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InquiryNotification extends Notification
{
    use Queueable;

    public $inquiry;

    /**
     * Create a new notification instance.
     */
    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
     public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Inquiry Received')
            ->greeting('Hello Admin,')
            ->line('A new inquiry has been submitted on the website.')
            ->line('Name: ' . $this->inquiry->name)
            ->line('Email: ' . $this->inquiry->email)
            ->line('Message:')
            ->line('"' . $this->inquiry->message . '"')
            ->action('Notification Action', url('/'))
            ->salutation('Best regards, Twin Real Estate');
    }
}

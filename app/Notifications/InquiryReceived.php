<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InquiryReceived extends Notification
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
            ->subject('Thank you for your inquiry')
            ->greeting('Hello ' . $this->inquiry->name . '!')
            ->line('Thank you for contacting us. We have received your message:')
            ->line('"' . $this->inquiry->message . '"')
            ->line('We will get back to you soon.')
            ->salutation('Best regards, Twin Real Estate');
    }
}

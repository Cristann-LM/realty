<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InquiryReply extends Notification
{
    use Queueable;

    protected $inquiry;
    protected $reply;

    /**
     * Create a new notification instance.
     */
    public function __construct($inquiry, $reply)
    {
        $this->inquiry = $inquiry;
        $this->reply = $reply;
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
        return (new MailMessage)
            ->subject('Reply to Your Inquiry')
            ->greeting('Hello ' . ($this->inquiry->name ?? ''))
            ->line('Thank you for reaching out to us. Here is our reply to your inquiry:')
            ->line('---')
            ->line('**Your Message:**')
            ->line($this->inquiry->message ?? '')
            ->line('---')
            ->line('**Our Reply:**')
            ->line($this->reply)
            ->salutation('Best regards, Twin Real Estate');
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

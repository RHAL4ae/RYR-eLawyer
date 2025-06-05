<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class HearingNotification extends Notification
{
    use Queueable;

    public function __construct(public string $title, public \DateTimeInterface $startAt)
    {
        //
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];
    }

    public function toMail(object $notifiable)
    {
        return (new MailMessage)
            ->subject('Upcoming Hearing')
            ->line("{$this->title} scheduled")
            ->line('Start: ' . $this->startAt->format('Y-m-d H:i'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => $this->title,
            'start_at' => $this->startAt,
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}

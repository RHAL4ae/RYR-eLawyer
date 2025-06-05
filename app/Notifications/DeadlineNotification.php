<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class DeadlineNotification extends Notification
{
    use Queueable;

    public function __construct(public string $description, public \DateTimeInterface $dueAt)
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
            ->subject('Upcoming Deadline')
            ->line($this->description)
            ->line('Due: ' . $this->dueAt->format('Y-m-d H:i'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'description' => $this->description,
            'due_at' => $this->dueAt,
        ];
    }

    public function toBroadcast(object $notifiable)
    {
        return new BroadcastMessage($this->toArray($notifiable));
    }
}

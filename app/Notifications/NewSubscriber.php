<?php

namespace App\Notifications;

use App\Models\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewSubscriber extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Subscriber $subscriber
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Newsletter Subscriber')
            ->greeting('Hello Admin!')
            ->line('You have a new newsletter subscriber.')
            ->line('**Email:** ' . $this->subscriber->email)
            ->line('**Subscribed on:** ' . $this->subscriber->created_at->format('F d, Y'))
            ->action('View All Subscribers', url('/admin/subscribers'))
            ->line('---')
            ->line('Total subscribers: ' . Subscriber::count());
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'new_subscriber',
            'subscriber_id' => $this->subscriber->id,
            'email' => $this->subscriber->email,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }
}

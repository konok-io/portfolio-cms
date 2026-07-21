<?php

namespace App\Notifications;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewContactMessage extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public ContactMessage $message
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Contact Message from ' . $this->message->name)
            ->greeting('Hello Admin!')
            ->line('You have received a new contact message.')
            ->line('**Name:** ' . $this->message->name)
            ->line('**Email:** ' . $this->message->email)
            ->line('**Subject:** ' . $this->message->subject)
            ->line('**Message:**')
            ->text($this->message->message)
            ->action('View All Messages', url('/admin/messages'))
            ->line('---')
            ->line('This message was sent on ' . $this->message->created_at->format('F d, Y \a\t h:i A'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'contact_message',
            'message_id' => $this->message->id,
            'name' => $this->message->name,
            'email' => $this->message->email,
            'subject' => $this->message->subject,
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return $this->toArray($notifiable);
    }
}

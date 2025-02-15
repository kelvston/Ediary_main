<?php

namespace App\Notifications;

use Illuminate\Broadcasting\Channel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification
{
    use Queueable;
    protected $reminder;

    public function __construct($reminder)
    {
        $this->reminder = $reminder;
    }
    public function broadcastOn()
    {
        return new Channel('reminder-channel');
    }
    /**
     * Create a new notification instance.
     */


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
//    public function via(object $notifiable): array
//    {
//        return ['mail'];
//    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Reminder: ' . $this->reminder->reminder_text)
            ->line('You have a reminder for the case ID: ' . $this->reminder->case_id)
            ->line('Reminder Text: ' . $this->reminder->reminder_text)
            ->line('Reminder Date: ' . $this->reminder->reminder_date);
    }

    public function toDatabase($notifiable)
    {
        return [
            'case_id' => $this->reminder->case_id,
            'reminder_text' => $this->reminder->reminder_text,
            'reminder_date' => $this->reminder->reminder_date,
        ];
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

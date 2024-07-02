<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EmailDatabaseBackup extends Notification
{
    use Queueable;
    protected $backupfile;

    /**
     * Create a new notification instance.
     */
    public function __construct($backupfile)
    {
        $this->backupfile = $backupfile;
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
    public function toMail(object $notifiable)
    {
        return (new MailMessage)
                    ->line('Please CheckOut The Database Backup File')
                    ->line('Attached is the latest database backup.')
                    ->line('Date: ' . date('Y-m-d H:i:s'))
                    ->attach($this->backupfile)
                    ->salutation('KenakataBD');
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

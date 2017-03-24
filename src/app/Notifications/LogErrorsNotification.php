<?php

namespace LaravelEnso\LogManager\App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;

class LogErrorsNotification extends Notification
{
    use Queueable, InteractsWithQueue;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $logErrors;

    public function __construct($logErrors)
    {
        $this->logErrors = $logErrors;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage())
            ->subject('Error Log from '.env('APP_NAME'))
            ->line($this->logErrors->count().' individual errors:');

        foreach ($this->logErrors as $logError) {
            $mailMessage = $mailMessage->line($logError);
        }

        return $mailMessage;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

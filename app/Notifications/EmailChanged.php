<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class EmailChanged extends Notification
{
    use Queueable;

    public $verfiy_token;
    public $first_name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($verify_token, $first_name)
    {
        $this->verify_token = $verify_token;
        $this->first_name = $first_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(config("app.name", "Logi Jobs")." - ".__("commons.verify_account"))
            ->greeting(__("commons.hi")." ".$this->first_name)
            ->line(__("commons.email_changed_txt"))
            ->action(__("commons.verify_account"), url('/register/confirm', $this->verify_token));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

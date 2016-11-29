<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MailResetPasswordToken extends Notification
{
    use Queueable;

    public $token;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
            ->subject("Parooli taastamine")
            ->greeting("Tere " . ucfirst($notifiable->first_name). " " . ucfirst($notifiable->last_name . '!'))
            ->line('Olete taotlenud oma konto "'. $notifiable->username.'" salasõna taastamist. Selle tegemiseks palun vajutage allolevat nuppu ')
            ->action('Salasõna taastamine', url('password/reset', $this->token))
            ->line('Kui te ei ole sellist teenust taotlenud, siis ei pea te midagi tegema.');
    }
}

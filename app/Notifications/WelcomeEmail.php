<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeEmail extends Notification
{
    use Queueable;

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
    public  $token;
    public function __construct($token)
    {
        //
        $this->token = $token;
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
            ->greeting('Yokoso! Selamat Datang di Dunia Kami!')
            ->line('Arigatou gozaimasu, telah mendaftar di dunia kami yang penuh petualangan dan kejutan!')
            ->action('Jelajahi Dunia Baru', url('/'))
            ->line('Jika ada pertanyaan atau bantuan, jangan ragu untuk memanggil kami—seperti seorang protagonis memanggil sekutu dalam pertempuran!')
            ->salutation('Salam hangat, Tim Anime Fantasi!');
    }
}

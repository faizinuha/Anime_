<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomPasswordResetNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public  $token;
    public function __construct($token)
    {
        //
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Pemberitahuan Reset Password dari Dunia Anime!')
            ->greeting('Yahoo, '. $notifiable->name.'!')
            ->line('Oh tidak! Lupa password? Sepertinya kamu terlalu sibuk di dunia anime...')
            ->line('Tenang saja, kami di sini untuk membantumu! Kamu menerima email ini karena kami menerima permintaan reset password untuk akun kamu.')
            ->action(Lang::get('Reset Password'), url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()])))
            ->line('Tapi hati-hati, seperti timer dalam pertarungan, link ini hanya berlaku 60 menit! Jangan sampai terlambat, ya!')
            ->line('Jika kamu tidak merasa meminta reset password, abaikan saja email ini. Seperti misi yang gagal, tidak perlu khawatir.')
            ->line('Terima kasih sudah menjadi bagian dari dunia kami,')
            ->salutation('Salam dari Dunia Anime, Saya Mahirocustomer!');
    }
    
    
   
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}

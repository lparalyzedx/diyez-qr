<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PasswordReset extends Notification
{
    use Queueable;
    public $token;

    /**
     * Create a new notification instance.
     */
    public function __construct($token)
    {
        $this->token = $token;
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
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from('info@yikamatakip.com', config('app.name'))
            ->subject('Şifreyi Sıfırla')
            ->greeting('Merhaba!')
            ->line('Bu e-postayı, hesabınız için bir şifre sıfırlama talebi aldığımız için alıyorsunuz.')
            ->action('Şifreyi Sıfırla', url('sifreyi-sifirla', $this->token))
            ->line('Parola sıfırlama talebinde bulunmadıysanız başka bir işlem yapmanız gerekmez.')
            ->salutation("Saygılar, " . config('app.name'));
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
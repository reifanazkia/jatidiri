<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class CustomResetPassword extends Notification
{
    public $token;

    /**
     * Buat constructor dengan token reset.
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Notifikasi dikirim via email.
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Format email reset password.
     */
    public function toMail($notifiable)
    {
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));

        return (new MailMessage)
            ->subject('Reset Password Anda')
            ->greeting('Halo!')
            ->line('Kami menerima permintaan untuk mereset password akun Anda.')
            ->action('Reset Password', $resetUrl)
            ->line('Link ini akan kadaluarsa dalam 60 menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini.')
            ->salutation('Salam, ' . config('app.name'));
    }

    /**
     * Representasi array (tidak dipakai di sini).
     */
    public function toArray($notifiable)
    {
        return [];
    }
}

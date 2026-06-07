<?php

namespace App\Notifications;

use App\Models\Store;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InclusiveExpiredNotification extends Notification
{
    public function __construct(public Store $store)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Masa Akses Program Inklusif EtalaseKu Telah Berakhir')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Masa akses Program Inklusif EtalaseKu Anda telah berakhir.')
            ->line('Toko Anda telah dikembalikan ke **Plan Free**. Anda masih bisa melanjutkan penggunaan EtalaseKu dengan fitur dasar.')
            ->line('Jika Anda ingin tetap menggunakan fitur Pro, Anda bisa berlangganan kapan saja.')
            ->action('Berlangganan Pro', url('/seller/upgrade'))
            ->salutation('Salam, Tim EtalaseKu ❤️');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}

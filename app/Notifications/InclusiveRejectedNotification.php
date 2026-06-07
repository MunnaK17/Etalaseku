<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InclusiveRejectedNotification extends Notification
{
    public function __construct()
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Update Permohonan Program Inklusif EtalaseKu')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Terima kasih telah mengajukan Program Inklusif EtalaseKu.')
            ->line('Mohon maaf, permohonan Anda belum dapat kami setujui pada saat ini.')
            ->line('Jika Anda memiliki pertanyaan atau ingin mengajukan kembali dengan informasi tambahan, silakan hubungi tim kami.')
            ->action('Hubungi Kami', url('/'))
            ->salutation('Salam, Tim EtalaseKu');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}

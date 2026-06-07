<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class InclusiveApprovedNotification extends Notification
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
            ->subject('Selamat! Permohonan Program Inklusif EtalaseKu Disetujui')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Permohonan Program Inklusif EtalaseKu Anda telah **disetujui**!')
            ->line('Anda sekarang mendapatkan akses **Plan Pro gratis selama 6 bulan** sebagai bagian dari Program Inklusif EtalaseKu.')
            ->line('Berikut benefit yang Anda dapatkan:')
            ->line('✅ Produk Unlimited')
            ->line('✅ Tanpa Watermark')
            ->line('✅ Produk Digital')
            ->line('✅ Custom Theme')
            ->line('✅ Checkout System')
            ->line('Masa aktif Anda berlaku hingga **' . now()->addMonths(6)->format('d M Y') . '**.')
            ->action('Buka Dashboard', url('/seller/dashboard'))
            ->line('Jika masa berlaku berakhir, akun Anda akan dikembalikan ke Plan Free secara otomatis.')
            ->salutation('Salam, Tim EtalaseKu ❤️');
    }

    public function toArray(object $notifiable): array
    {
        return [];
    }
}

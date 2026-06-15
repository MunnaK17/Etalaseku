<?php

namespace App\Notifications;

use App\Models\SellerVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationApprovedNotification extends Notification
{
    use Queueable;

    protected $verification;

    /**
     * Create a new notification instance.
     */
    public function __construct(SellerVerification $verification)
    {
        $this->verification = $verification;
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
        $storeName = $this->verification->store->name ?? 'Toko Anda';

        return (new MailMessage)
            ->subject('🎉 Selamat! Seller Kamu Telah Terverifikasi - EtalaseKu')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Bagus kabar nya! Dokumen verifikasi seller untuk **' . $storeName . '** telah **disetujui** oleh tim kami.')
            ->line('Sekarang etalase kamu akan menampilkan badge **Verified Seller** yang meningkatkan kepercayaan pembeli.')
            ->line('✓ Akun seller terverifikasi')
            ->line('✓ Badge verified di etalase publik')
            ->line('✓ Meningkatkan kepercayaan pembeli')
            ->action('Lihat Etalase Kamu', $this->verification->store->public_url ?? url('/'))
            ->line('Jika ada pertanyaan, jangan ragu untuk menghubungi tim kami.')
            ->salutation('Salam, Tim EtalaseKu ❤️');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'verification_id' => $this->verification->id,
            'store_id' => $this->verification->store_id,
            'status' => 'approved',
        ];
    }
}

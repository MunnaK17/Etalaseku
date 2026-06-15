<?php

namespace App\Notifications;

use App\Models\SellerVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerificationRejectedNotification extends Notification
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
        $rejectionReason = $this->verification->admin_notes ?? 'Dokumen tidak memenuhi persyaratan.';

        return (new MailMessage)
            ->subject('⚠️ Verifikasi Seller Ditolak - EtalaseKu')
            ->greeting('Halo ' . $notifiable->name . '!')
            ->line('Mohon maaf, verifikasi seller untuk **' . $storeName . '** **ditolak**.')
            ->line('**Alasan penolakan:**')
            ->line($rejectionReason)
            ->line('')
            ->line('Kamu dapat mengajukan verifikasi ulang dengan dokumen yang benar.')
            ->action('Ajukan Verifikasi Ulang', route('seller.verification.index'))
            ->line('Tips untuk verifikasi yang berhasil:')
            ->line('• Pastikan foto KTP jelas dan tidak blur')
            ->line('• Pastikan NPWP masih berlaku')
            ->line('• Selfie harus jelas menampilkan wajah dan KTP')
            ->line('• Dokumen harus lengkap dan readable')
            ->line('')
            ->line('Jika ada pertanyaan, jangan ragu untuk menghubungi tim kami.')
            ->salutation('Salam, Tim EtalaseKu');
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
            'status' => 'rejected',
            'reason' => $this->verification->admin_notes,
        ];
    }
}

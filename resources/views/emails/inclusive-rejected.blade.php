<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Update Permohonan Inclusive Program</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: #64748b; padding: 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 800;">Update Permohonan</h1>
                            <p style="margin: 10px 0 0; color: #e2e8f0; font-size: 18px;">Inclusive Program EtalaseKu</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Halo <strong>{{ $application->applicant_name }}</strong>,
                            </p>

                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Terima kasih telah mengajukan Inclusive Program EtalaseKu.
                            </p>

                            <div style="background: #fef2f2; border: 1px solid #fecaca; border-radius: 12px; padding: 24px; margin: 24px 0;">
                                <h2 style="margin: 0 0 12px; color: #dc2626; font-size: 18px;">⚠️ Mohon Maaf</h2>
                                <p style="margin: 0; color: #334155; font-size: 15px; line-height: 1.6;">
                                    Permohonan Inclusive Program Anda belum dapat kami setujui saat ini.
                                </p>
                                @if($application->rejection_reason)
                                <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid #fecaca;">
                                    <p style="margin: 0; color: #64748b; font-size: 14px;">
                                        <strong>Alasan:</strong> {{ $application->rejection_reason }}
                                    </p>
                                </div>
                                @endif
                            </div>

                            <p style="margin: 24px 0; color: #334155; font-size: 16px; line-height: 1.6;">
                                Jangan menyerah! Anda tetap bisa:<br>
                                • Mengajukan permohonan kembali dengan dokumen yang lebih lengkap<br>
                                • Mendaftar sebagai seller reguler di <a href="{{ url('/register') }}" style="color: #F59E0B;">EtalaseKu</a>
                            </p>

                            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px; padding: 20px; margin: 24px 0; text-align: center;">
                                <p style="margin: 0; color: #059669; font-size: 14px;">
                                    💪 "Setiap langkah kecil adalah kemajuan.<br>Terus berusaha dan jangan pernah menyerah!"
                                </p>
                            </div>

                            <p style="margin: 24px 0 0; color: #64748b; font-size: 14px; text-align: center;">
                                Jika ada pertanyaan, jangan ragu untuk menghubungi kami.<br>
                                ❤️ Tim EtalaseKu
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #f1f5f9; padding: 24px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                &copy; {{ date('Y') }} EtalaseKu. Semua hak dilindungi.<br>
                                Email ini dikirim otomatis, mohon jangan membalas email ini.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
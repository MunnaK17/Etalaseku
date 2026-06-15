<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Permohonan Disetujui</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #FFD700 0%, #F59E0B 100%); padding: 40px; text-align: center;">
                            <h1 style="margin: 0; color: #000; font-size: 28px; font-weight: 800;">🎉 Selamat!</h1>
                            <p style="margin: 10px 0 0; color: #000; font-size: 18px;">Permohonan Inclusive Program Disetujui</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Halo <strong>{{ $application->applicant_name }}</strong>,
                            </p>

                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Selamat! Permohonan Inclusive Program Anda telah <strong style="color: #059669;">DISETUJUI</strong>.
                            </p>

                            <div style="background: linear-gradient(135deg, rgba(255,215,0,0.1) 0%, rgba(245,158,11,0.1) 100%); border-radius: 12px; padding: 24px; margin: 24px 0;">
                                <h2 style="margin: 0 0 16px; color: #0f172a; font-size: 20px;">✨ Keuntungan yang Anda Dapatkan</h2>
                                <table width="100%" cellpadding="8" cellspacing="0">
                                    <tr>
                                        <td style="color: #059669; font-size: 18px;">✓</td>
                                        <td style="color: #334155;">Plan Pro <strong>GRATIS</strong> selama 6 bulan</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #059669; font-size: 18px;">✓</td>
                                        <td style="color: #334155;">Produk <strong>Unlimited</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #059669; font-size: 18px;">✓</td>
                                        <td style="color: #334155;">Tanpa Watermark</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #059669; font-size: 18px;">✓</td>
                                        <td style="color: #334155;">Custom Theme</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #059669; font-size: 18px;">✓</td>
                                        <td style="color: #334155;">Checkout System untuk Produk Digital</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Login Info -->
                            <div style="background: #0f172a; border-radius: 12px; padding: 24px; margin: 24px 0;">
                                <h3 style="margin: 0 0 16px; color: #FFD700; font-size: 16px;">🔐 Informasi Login Anda</h3>
                                <table width="100%" cellpadding="8" cellspacing="0">
                                    <tr>
                                        <td style="color: #94a3b8; width: 100px;">Email</td>
                                        <td style="color: #ffffff;"><strong>{{ $application->email }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #94a3b8;">Password</td>
                                        <td style="color: #ffffff;"><code style="background: #1e293b; padding: 4px 8px; border-radius: 4px; font-family: monospace;">{{ $tempPassword }}</code></td>
                                    </tr>
                                </table>
                                <p style="margin: 16px 0 0; color: #94a3b8; font-size: 14px;">
                                    ⚠️ <em>Kami sarankan untuk mengganti password Anda setelah login.</em>
                                </p>
                            </div>

                            <!-- CTA Button -->
                            <div style="text-align: center; margin: 32px 0;">
                                <a href="{{ $loginUrl }}" style="display: inline-block; background: linear-gradient(135deg, #FFD700 0%, #F59E0B 100%); color: #000; text-decoration: none; padding: 16px 32px; border-radius: 12px; font-size: 16px; font-weight: 600;">
                                    Masuk ke Dashboard
                                </a>
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
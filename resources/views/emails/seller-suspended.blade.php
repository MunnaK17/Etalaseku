<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akun Ditangguhkan</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #DC2626 0%, #B91C1C 100%); padding: 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 800;">⚠️ Akun Ditangguhkan</h1>
                            <p style="margin: 10px 0 0; color: #fecaca; font-size: 18px;">EtalaseKu Store Management</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Halo <strong>{{ $store->user->name ?? 'Seller' }}</strong>,
                            </p>

                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Dengan berat hati kami menginformasikan bahwa akun EtalaseKu Anda telah <strong style="color: #DC2626;">DITANGGUHKAN</strong>.
                            </p>

                            <!-- Store Info -->
                            <div style="background: #f1f5f9; border-radius: 12px; padding: 24px; margin: 24px 0;">
                                <h3 style="margin: 0 0 16px; color: #0f172a; font-size: 16px;">📋 Detail Store</h3>
                                <table width="100%" cellpadding="8" cellspacing="0">
                                    <tr>
                                        <td style="color: #64748b; width: 120px;">Nama Store</td>
                                        <td style="color: #0f172a;"><strong>{{ $store->name }}</strong></td>
                                    </tr>
                                    <tr>
                                        <td style="color: #64748b;">Username</td>
                                        <td style="color: #0f172a;">{{ $store->username }}</td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Reason -->
                            <div style="background: #FEF2F2; border-radius: 12px; padding: 24px; margin: 24px 0; border-left: 4px solid #DC2626;">
                                <h3 style="margin: 0 0 12px; color: #991B1B; font-size: 16px;">📝 Alasan Penangguhan</h3>
                                <p style="margin: 0; color: #7F1D1D; font-size: 15px; line-height: 1.6;">
                                    {{ $reason }}
                                </p>
                            </div>

                            <!-- Info -->
                            <div style="background: #fffbeb; border-radius: 12px; padding: 24px; margin: 24px 0; border-left: 4px solid #F59E0B;">
                                <p style="margin: 0; color: #92400e; font-size: 15px; line-height: 1.6;">
                                    Saat akun ditangguhkan, Anda tidak dapat:
                                </p>
                                <ul style="margin: 12px 0 0; color: #92400e; font-size: 15px; line-height: 1.8;">
                                    <li>Masuk ke dashboard seller</li>
                                    <li>Mengelola produk</li>
                                    <li>Melihat atau memproses pesanan</li>
                                    <li>Mengakses statistik toko</li>
                                </ul>
                            </div>

                            <!-- Contact -->
                            <p style="margin: 24px 0; color: #334155; font-size: 16px; line-height: 1.6;">
                                Jika Anda merasa penangguhan ini dilakukan secara tidak adil atau ingin mengajukan banding, silakan hubungi tim support kami dengan menyertakan informasi lengkap.
                            </p>

                            <p style="margin: 24px 0 0; color: #64748b; font-size: 14px; text-align: center;">
                                ❤️ Tim EtalaseKu<br>
                                <small>Email ini dikirim secara otomatis, mohon jangan membalas email ini.</small>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background: #f1f5f9; padding: 24px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                &copy; {{ date('Y') }} EtalaseKu. Semua hak dilindungi.<br>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
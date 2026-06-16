<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Produk Digital Anda Sudah Siap</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif; background-color: #f8fafc;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f8fafc; padding: 40px 20px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #8B5CF6 0%, #6366F1 100%); padding: 40px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 800;">🎉 Selamat!</h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 18px;">Produk Digital Anda Sudah Siap Di Download</p>
                        </td>
                    </tr>

                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px;">
                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Halo <strong>{{ $customerName }}</strong>,
                            </p>

                            <p style="margin: 0 0 20px; color: #334155; font-size: 16px; line-height: 1.6;">
                                Pembayaran Anda telah <strong style="color: #059669;">DITERIMA</strong> dan produk digital Anda sudah siap untuk didownload!
                            </p>

                            <!-- Order Info -->
                            <div style="background: #f8fafc; border-radius: 12px; padding: 24px; margin: 24px 0; border: 1px solid #e2e8f0;">
                                <h3 style="margin: 0 0 16px; color: #0f172a; font-size: 16px; font-weight: 600;">📦 Detail Pesanan</h3>
                                <table width="100%" cellpadding="8" cellspacing="0">
                                    <tr>
                                        <td style="color: #64748b; width: 120px;">Nama Produk</td>
                                        <td style="color: #0f172a; font-weight: 500;">{{ $productName }}</td>
                                    </tr>
                                    <tr>
                                        <td style="color: #64748b;">Order Number</td>
                                        <td style="color: #0f172a; font-weight: 500;"><code style="background: #e2e8f0; padding: 2px 8px; border-radius: 4px; font-family: monospace;">{{ $orderNumber }}</code></td>
                                    </tr>
                                </table>
                            </div>

                            @if($downloadUrl)
                            <!-- Download Button -->
                            <div style="text-align: center; margin: 32px 0;">
                                <a href="{{ $downloadUrl }}" style="display: inline-block; background: linear-gradient(135deg, #8B5CF6 0%, #6366F1 100%); color: #ffffff; text-decoration: none; padding: 16px 48px; border-radius: 12px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 14px rgba(139, 92, 246, 0.4);">
                                    <svg style="vertical-align: middle; margin-right: 8px;" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    Download Produk Digital
                                </a>
                            </div>

                            <div style="background: #fef3c7; border-radius: 8px; padding: 16px; margin: 24px 0;">
                                <p style="margin: 0; color: #92400e; font-size: 14px;">
                                    <strong>⚠️ Catatan Penting:</strong><br>
                                    Link download ini hanya untuk Anda. Jangan bagikan link ini kepada orang lain.
                                </p>
                            </div>
                            @else
                            <div style="background: #fee2e2; border-radius: 8px; padding: 16px; margin: 24px 0;">
                                <p style="margin: 0; color: #991b1b; font-size: 14px;">
                                    <strong>⚠️ Informasi:</strong><br>
                                    Produk digital ini belum memiliki link download. Silakan hubungi seller untuk informasi lebih lanjut.
                                </p>
                            </div>
                            @endif

                            <p style="margin: 24px 0 0; color: #64748b; font-size: 14px; line-height: 1.6;">
                                Jika ada pertanyaan mengenai produk digital Anda, jangan ragu untuk menghubungi seller.<br>
                                Terima kasih telah berbelanja di <strong>EtalaseKu</strong>! ❤️
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

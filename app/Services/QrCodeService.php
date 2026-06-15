<?php

namespace App\Services;

/**
 * QR Code Service
 *
 * Provides QR code generation using client-side JavaScript library (qrcode.js)
 * This approach avoids server-side dependencies and allows dynamic customization.
 */
class QrCodeService
{
    /**
     * Get QR code CDN script.
     */
    public function getCdnScript(): string
    {
        return 'https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js';
    }

    /**
     * Generate QR code data URL using server-side calculation.
     * Uses a simplified approach for compatibility.
     */
    public function generateDataUrl(string $url, array $options = []): string
    {
        $size = $options['size'] ?? 300;
        $margin = $options['margin'] ?? 2;

        // Use Google Chart API as fallback/alternative
        $encodedUrl = urlencode($url);
        $sizeParam = $options['download'] ?? false ? '' : '&size=' . $size . 'x' . $size . '&margin=' . $margin;

        return "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&margin={$margin}&data={$encodedUrl}";
    }

    /**
     * Generate download URL for QR code.
     */
    public function getDownloadUrl(string $url, array $options = []): string
    {
        $size = $options['size'] ?? 600;
        $format = $options['format'] ?? 'png';
        $margin = $options['margin'] ?? 2;

        $encodedUrl = urlencode($url);

        // Using QR Server API for better quality downloads
        return "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&margin={$margin}&format={$format}&data={$encodedUrl}";
    }

    /**
     * Get QR code with custom colors.
     */
    public function getColoredQrUrl(string $url, string $color = '#000000', string $bgcolor = '#ffffff', int $size = 300): string
    {
        $encodedUrl = urlencode($url);
        $colorHex = ltrim($color, '#');
        $bgcolorHex = ltrim($bgcolor, '#');

        return "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&color={$colorHex}&bgcolor={$bgcolorHex}&data={$encodedUrl}";
    }

    /**
     * Get store URL for QR code.
     */
    public function getStoreQrUrl(string $username, array $options = []): string
    {
        $baseUrl = config('app.url', 'https://etalaseku.com');
        $storeUrl = rtrim($baseUrl, '/') . '/' . $username;

        return $this->generateDataUrl($storeUrl, $options);
    }

    /**
     * Generate JavaScript code for client-side QR rendering.
     */
    public function getClientScript(string $elementId, string $url, array $options = []): string
    {
        $size = $options['size'] ?? 300;
        $color = $options['color'] ?? '#000000';
        $bgcolor = $options['bgcolor'] ?? '#ffffff';

        return <<<JS
if (typeof QRCode !== 'undefined') {
    new QRCode(document.getElementById("{$elementId}"), {
        text: "{$url}",
        width: {$size},
        height: {$size},
        colorDark: "{$color}",
        colorLight: "{$bgcolor}",
        correctLevel: QRCode.CorrectLevel.H
    });
}
JS;
    }
}

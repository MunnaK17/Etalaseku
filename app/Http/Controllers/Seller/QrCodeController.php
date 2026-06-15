<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Services\QrCodeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class QrCodeController extends Controller
{
    protected $qrCodeService;

    public function __construct(QrCodeService $qrCodeService)
    {
        $this->qrCodeService = $qrCodeService;
    }

    /**
     * Display QR code generator page.
     */
    public function index(): View
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        $storeUrl = url('/' . $store->username);

        return view('seller.qr-code.index', [
            'store' => $store,
            'storeUrl' => $storeUrl,
        ]);
    }

    /**
     * Generate QR code preview via API.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'size' => 'nullable|integer|min:100|max:600',
            'color' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
            'bgcolor' => 'nullable|string|regex:/^#[0-9A-Fa-f]{6}$/',
        ]);

        $url = $request->input('url');
        $size = $request->input('size', 300);
        $color = $request->input('color', '#000000');
        $bgcolor = $request->input('bgcolor', '#ffffff');

        $qrUrl = $this->qrCodeService->getColoredQrUrl($url, $color, $bgcolor, $size);

        return response()->json([
            'success' => true,
            'qr_url' => $qrUrl,
            'download_url' => $this->qrCodeService->getDownloadUrl($url, [
                'size' => 600,
                'format' => 'png',
            ]),
        ]);
    }

    /**
     * Download QR code as PNG.
     */
    public function download(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'size' => 'nullable|integer|min:100|max=1000',
            'color' => 'nullable|string',
            'bgcolor' => 'nullable|string',
            'format' => 'nullable|in:png,svg',
        ]);

        $url = $request->input('url');
        $size = $request->input('size', 600);
        $color = $request->input('color', '#000000');
        $bgcolor = $request->input('bgcolor', '#ffffff');
        $format = $request->input('format', 'png');

        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size={$size}x{$size}&format={$format}&color=" . ltrim($color, '#') . "&bgcolor=" . ltrim($bgcolor, '#') . "&data=" . urlencode($url);

        // Get the image data
        $context = stream_context_create([
            'http' => [
                'method' => 'GET',
                'header' => "User-Agent: Mozilla/5.0\r\n",
            ],
        ]);

        $imageData = @file_get_contents($qrUrl, false, $context);

        if ($imageData === false) {
            return back()->with('error', 'Gagal generate QR code. Coba lagi.');
        }

        // Generate filename
        $username = auth()->user()->store?->username ?? 'store';
        $filename = "qrcode-{$username}-" . date('Ymd-His') . ".{$format}";

        return response($imageData, 200, [
            'Content-Type' => $format === 'svg' ? 'image/svg+xml' : 'image/png',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'no-store, no-cache',
        ]);
    }
}

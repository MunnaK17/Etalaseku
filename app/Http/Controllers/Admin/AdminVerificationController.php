<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerVerification;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminVerificationController extends Controller
{
    /**
     * Display a listing of verifications.
     */
    public function index(Request $request): View
    {
        $query = SellerVerification::with(['user', 'store']);

        // Filter by status
        if ($request->has('status') && in_array($request->status, ['pending', 'verified', 'rejected'])) {
            $query->where('status', $request->status);
        }

        // Search by name or store
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('full_name', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhereHas('store', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('username', 'like', "%{$search}%");
                  });
            });
        }

        // Sort
        $sortBy = $request->get('sort', 'newest');
        if ($sortBy === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $verifications = $query->paginate(15)->withQueryString();

        // Stats
        $stats = [
            'pending' => SellerVerification::pending()->count(),
            'verified' => SellerVerification::verified()->count(),
            'rejected' => SellerVerification::rejected()->count(),
            'total' => SellerVerification::count(),
        ];

        return view('admin.verifications.index', compact('verifications', 'stats'));
    }

    /**
     * Display the specified verification.
     */
    public function show(SellerVerification $verification): View
    {
        $verification->load(['user', 'store', 'reviewer']);

        return view('admin.verifications.show', compact('verification'));
    }

    /**
     * Approve the specified verification.
     */
    public function approve(Request $request, SellerVerification $verification): \Illuminate\Http\RedirectResponse
    {
        if ($verification->status !== SellerVerification::STATUS_PENDING) {
            return redirect()->back()->with('error', 'Verifikasi sudah diproses.');
        }

        // Update verification status
        $verification->update([
            'status' => SellerVerification::STATUS_VERIFIED,
            'admin_notes' => $request->admin_notes,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // Update store verification status
        $verification->store->update([
            'is_verified_seller' => true,
            'verified_at' => now(),
        ]);

        // Send notification
        if ($verification->user) {
            try {
                $verification->user->notify(new \App\Notifications\VerificationApprovedNotification($verification));
            } catch (\Throwable $e) {
                Log::warning('Failed to send verification approved notification', [
                    'verification_id' => $verification->id,
                    'user_id' => $verification->user_id,
                    'message' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('admin.verifications.index')
            ->with('success', 'Verifikasi seller berhasil disetujui!');
    }

    /**
     * Reject the specified verification.
     */
    public function reject(Request $request, SellerVerification $verification): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500',
        ], [
            'admin_notes.required' => 'Alasan penolakan wajib diisi.',
        ]);

        if ($verification->status !== SellerVerification::STATUS_PENDING) {
            return redirect()->back()->with('error', 'Verifikasi sudah diproses.');
        }

        // Update verification status
        $verification->update([
            'status' => SellerVerification::STATUS_REJECTED,
            'admin_notes' => $request->admin_notes,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        // Send notification
        if ($verification->user) {
            try {
                $verification->user->notify(new \App\Notifications\VerificationRejectedNotification($verification));
            } catch (\Throwable $e) {
                Log::warning('Failed to send verification rejected notification', [
                    'verification_id' => $verification->id,
                    'user_id' => $verification->user_id,
                    'message' => $e->getMessage(),
                ]);
            }
        }

        return redirect()->route('admin.verifications.index')
            ->with('success', 'Verifikasi seller ditolak.');
    }

    /**
     * Download a document.
     */
    public function downloadDocument(SellerVerification $verification, string $documentType): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $pathField = match ($documentType) {
            'ktp' => 'ktp_path',
            'npwp' => 'npwp_path',
            'siu' => 'siu_path',
            'selfie' => 'selfie_with_ktp_path',
            default => null,
        };

        if (!$pathField || !$verification->$pathField) {
            abort(404);
        }

        $path = str_replace('/storage/', '', $verification->$pathField);
        $fullPath = Storage::disk('public')->path($path);

        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->download($fullPath);
    }
}

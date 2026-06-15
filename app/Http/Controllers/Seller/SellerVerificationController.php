<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerVerificationRequest;
use App\Models\SellerVerification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SellerVerificationController extends Controller
{
    /**
     * Display the verification status and form.
     */
    public function index(Request $request): View
    {
        $store = $request->user()->store;
        $verification = $store->verification;

        return view('seller.verification.index', compact(
            'store',
            'verification'
        ));
    }

    /**
     * Show the verification details.
     */
    public function show(Request $request): View
    {
        $store = $request->user()->store;
        $verification = $store->verification;

        if (!$verification) {
            return redirect()->route('seller.verification.index');
        }

        return view('seller.verification.show', compact(
            'store',
            'verification'
        ));
    }

    /**
     * Store or update verification submission.
     */
    public function store(SellerVerificationRequest $request): RedirectResponse
    {
        $user = $request->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.dashboard')
                ->with('error', 'Toko tidak ditemukan!');
        }

        // Check if there's already a pending or verified verification
        $existingVerification = SellerVerification::where('store_id', $store->id)
            ->whereIn('status', [SellerVerification::STATUS_PENDING, SellerVerification::STATUS_VERIFIED])
            ->first();

        if ($existingVerification) {
            return redirect()->route('seller.verification.index')
                ->with('error', 'Verifikasi sudah ada yang sedang diproses atau sudah terverifikasi.');
        }

        // Prepare data
        $data = [
            'user_id' => $user->id,
            'store_id' => $store->id,
            'nik' => $request->nik,
            'full_name' => $request->full_name,
            'business_name' => $request->business_name,
            'business_type' => $request->business_type,
            'nib_number' => $request->nib_number,
            'status' => SellerVerification::STATUS_PENDING,
            'submitted_at' => now(),
        ];

        // Handle file uploads
        $directory = 'verifications/' . $user->id;
        $timestamp = now()->timestamp;

        if ($request->hasFile('ktp_file')) {
            $data['ktp_path'] = Storage::url($request->file('ktp_file')->storeAs($directory, "ktp_{$timestamp}.{$request->file('ktp_file')->getClientOriginalExtension()}", 'public'));
        }

        if ($request->hasFile('npwp_file')) {
            $data['npwp_path'] = Storage::url($request->file('npwp_file')->storeAs($directory, "npwp_{$timestamp}.{$request->file('npwp_file')->getClientOriginalExtension()}", 'public'));
        }

        if ($request->hasFile('siu_file')) {
            $data['siu_path'] = Storage::url($request->file('siu_file')->storeAs($directory, "siu_{$timestamp}.{$request->file('siu_file')->getClientOriginalExtension()}", 'public'));
        }

        if ($request->hasFile('selfie_file')) {
            $data['selfie_with_ktp_path'] = Storage::url($request->file('selfie_file')->storeAs($directory, "selfie_{$timestamp}.{$request->file('selfie_file')->getClientOriginalExtension()}", 'public'));
        }

        // Create verification
        SellerVerification::create($data);

        return redirect()->route('seller.verification.index')
            ->with('success', 'Dokumen berhasil diupload! Verifikasi Anda sedang dalam proses review.');
    }

    /**
     * Cancel pending verification (delete).
     */
    public function destroy(Request $request): RedirectResponse
    {
        $store = $request->user()->store;
        $verification = $store->verification;

        if (!$verification || !$verification->isPending) {
            return redirect()->route('seller.verification.index')
                ->with('error', 'Verifikasi tidak dapat dibatalkan.');
        }

        // Delete uploaded files
        $files = [$verification->ktp_path, $verification->npwp_path, $verification->siu_path, $verification->selfie_with_ktp_path];
        foreach ($files as $file) {
            if ($file) {
                $path = str_replace('/storage/', '', $file);
                Storage::disk('public')->delete($path);
            }
        }

        $verification->delete();

        return redirect()->route('seller.verification.index')
            ->with('success', 'Verifikasi berhasil dibatalkan.');
    }
}

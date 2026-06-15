<?php

namespace App\Http\Controllers;

use App\Models\InclusiveApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class InclusivePublicController extends Controller
{
    /**
     * Display the public inclusive program registration form.
     */
    public function showForm(): View
    {
        return view('inclusive-program.form');
    }

    /**
     * Handle form submission.
     */
    public function submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'applicant_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'disability_type' => 'required|string|in:physical,visual,hearing,intellectual,mental,multiple',
            'reason' => 'required|string|min:50|max:2000',
            'ktp_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'certificate_file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ], [
            'applicant_name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'disability_type.required' => 'Pilih jenis disabilitas.',
            'disability_type.in' => 'Jenis disabilitas tidak valid.',
            'reason.required' => 'Ceritakan kisah Anda wajib diisi.',
            'reason.min' => 'Minimal 50 karakter untuk ceritakan kisah Anda.',
            'ktp_file.max' => 'File KTP maksimal 2MB.',
            'ktp_file.mimes' => 'File KTP harus format JPG, PNG, atau PDF.',
            'certificate_file.max' => 'File sertifikat maksimal 2MB.',
            'certificate_file.mimes' => 'File sertifikat harus format JPG, PNG, atau PDF.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check if email already has pending application
        $existingApplication = InclusiveApplication::where('email', $request->email)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingApplication) {
            if ($existingApplication->status === 'approved') {
                return redirect()->back()
                    ->with('info', 'Email ini sudah terdaftar sebagai Inclusive Seller.');
            }
            return redirect()->back()
                ->with('info', 'Anda sudah memiliki permohonan yang sedang diproses.');
        }

        // Handle file uploads
        $ktpPath = null;
        $certPath = null;

        if ($request->hasFile('ktp_file')) {
            $ktpPath = $request->file('ktp_file')->store('inclusive-applications/ktp', 'public');
        }

        if ($request->hasFile('certificate_file')) {
            $certPath = $request->file('certificate_file')->store('inclusive-applications/certificates', 'public');
        }

        // Create application
        $application = InclusiveApplication::create([
            'applicant_name' => $request->applicant_name,
            'email' => $request->email,
            'whatsapp' => $this->formatWhatsApp($request->whatsapp),
            'disability_type' => $request->disability_type,
            'reason' => $request->reason,
            'expected_benefits' => $request->expected_benefits,
            'ktp_file' => $ktpPath,
            'certificate_file' => $certPath,
            'status' => 'pending',
        ]);

        return redirect()->back()
            ->with('success', 'Permohonan Inclusive Program berhasil dikirim! Kami akan mereview dalam 1-3 hari kerja.');
    }

    /**
     * Format WhatsApp number to standard format.
     */
    private function formatWhatsApp(string $number): string
    {
        // Remove all non-digit characters
        $number = preg_replace('/\D/', '', $number);

        // If starts with 0, replace with 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }

        // If doesn't start with 62, add it
        if (substr($number, 0, 2) !== '62') {
            $number = '62' . $number;
        }

        return $number;
    }
}

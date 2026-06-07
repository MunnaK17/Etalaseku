<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\InclusiveApplication;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InclusiveProgramController extends Controller
{
    /**
     * Display the inclusive program page.
     */
    public function index()
    {
        $user = auth()->user();
        $store = $user->store;

        // Get existing application if any
        $application = $store ? InclusiveApplication::where('store_id', $store->id)->first() : null;

        return view('seller.inclusive-program', [
            'store' => $store,
            'application' => $application,
        ]);
    }

    /**
     * Submit an inclusive program application.
     */
    public function submit(Request $request)
    {
        $user = auth()->user();
        $store = $user->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        // Check if already approved
        if ($store->is_inclusive_seller) {
            return redirect()
                ->route('seller.dashboard')
                ->with('info', 'Anda sudah menjadi Inclusive Seller!');
        }

        // Check if already has pending application
        $existingApplication = InclusiveApplication::where('store_id', $store->id)
            ->where('status', 'pending')
            ->first();

        if ($existingApplication) {
            return redirect()
                ->back()
                ->with('info', 'Permohonan Anda sedang dalam proses review.');
        }

        $validator = Validator::make($request->all(), [
            'disability_type' => 'required|string|max:255',
            'disability_certificate' => 'nullable|string|max:255',
            'reason' => 'required|string|min:50|max:1000',
            'expected_benefits' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the application
        InclusiveApplication::create([
            'store_id' => $store->id,
            'disability_type' => $request->disability_type,
            'disability_certificate' => $request->disability_certificate,
            'reason' => $request->reason,
            'expected_benefits' => $request->expected_benefits,
            'status' => 'pending',
        ]);

        return redirect()
            ->back()
            ->with('success', 'Permohonan Inclusive Program berhasil dikirim! Kami akan review dalam 1-3 hari kerja.');
    }

    /**
     * Submit inclusive program application via public API (landing page modal).
     * Forwards to n8n webhook which writes to Google Sheets.
     */
    public function submitPublic(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'disability_type' => 'required|string|in:physical,visual,hearing,intellectual,mental,multiple',
            'story' => 'required|string|min:50|max:2000',
            'certificate' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'whatsapp.required' => 'Nomor WhatsApp wajib diisi.',
            'disability_type.required' => 'Pilih jenis disabilitas.',
            'disability_type.in' => 'Jenis disabilitas tidak valid.',
            'story.required' => 'Ceritakan tentang Anda wajib diisi.',
            'story.min' => 'Minimal 50 karakter untuk ceritakan tentang Anda.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal.',
                'errors' => $validator->errors()->toArray(),
            ], 422);
        }

        $data = $validator->validated();
        $data['submitted_at'] = now()->format('Y-m-d H:i:s');
        $data['disability_type_display'] = match ($data['disability_type']) {
            'physical' => 'Disabilitas Fisik',
            'visual' => 'Disabilitas Netra / Tunanetra',
            'hearing' => 'Disabilitas Rungu / Wicara',
            'intellectual' => 'Disabilitas Intelektual',
            'mental' => 'Disabilitas Mental / Psikososial',
            'multiple' => 'Disabilitas Ganda',
            default => $data['disability_type'],
        };

        // Forward to n8n webhook (if configured)
        $n8nWebhookUrl = config('n8n.inclusive_webhook_url');

        if ($n8nWebhookUrl) {
            try {
                $response = Http::timeout(10)
                    ->withHeaders(['Content-Type' => 'application/json'])
                    ->post($n8nWebhookUrl, $data);

                if (!$response->successful()) {
                    Log::warning('Inclusive program n8n webhook failed', [
                        'status' => $response->status(),
                        'body' => $response->body(),
                    ]);
                }
            } catch (\Exception $e) {
                Log::error('Inclusive program n8n webhook error', [
                    'message' => $e->getMessage(),
                ]);
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Permohonan berhasil dikirim! Tim kami akan memproses dalam 1-3 hari kerja.',
        ]);
    }
}

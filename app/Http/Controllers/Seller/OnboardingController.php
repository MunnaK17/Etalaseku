<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Page;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    /**
     * Display the onboarding page.
     */
    public function index(): View
    {
        return view('seller.onboarding');
    }

    /**
     * Handle the onboarding store creation.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Check if user already has a store
        if ($user->store) {
            return redirect()->route('seller.dashboard');
        }

        // Check if username is already taken
        if (Store::where('username', $request->username)->exists()) {
            return back()
                ->withInput()
                ->withErrors(['username' => 'Username sudah digunakan oleh toko lain.']);
        }

        $store = DB::transaction(function () use ($request, $user) {
            $store = Store::create([
                'user_id' => $user->id,
                'name' => $request->name,
                'username' => $request->username,
                'description' => $request->description,
                'whatsapp' => $request->whatsapp,
                'theme' => 'minimal',
                'plan' => 'free',
            ]);

            Page::ensureDefaultForUser($user->id, 'Halaman Utama', 1);

            return $store;
        });

        return redirect()
            ->route('seller.dashboard')
            ->with('success', "Selamat! Etalase '{$store->name}' berhasil dibuat!");
    }
}

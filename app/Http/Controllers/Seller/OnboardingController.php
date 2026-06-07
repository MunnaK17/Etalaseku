<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
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

        // Create the store
        $store = Store::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'username' => $request->username,
            'description' => $request->description,
            'whatsapp' => $request->whatsapp,
            'theme' => 'minimal',
            'plan' => 'free',
        ]);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', "Selamat! Etalase '{$store->name}' berhasil dibuat!");
    }
}

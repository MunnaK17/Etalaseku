<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    /**
     * Display the store settings page.
     */
    public function edit(Request $request): View
    {
        $store = $request->user()->store;
        $layouts = Store::getLayouts();
        $fonts = Store::getAvailableFonts();
        $templatePresets = Store::getTemplatePresets();

        return view('seller.store.edit', compact(
            'store',
            'layouts',
            'fonts',
            'templatePresets'
        ));
    }

    /**
     * Update the store settings.
     */
    public function update(StoreRequest $request): RedirectResponse
    {
        $store = $request->user()->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        // Update with PRO restrictions applied
        $validated = $request->validatedWithProRestrictions($store);
        $store->update($validated);

        return redirect()
            ->route('seller.store.edit')
            ->with('success', 'Pengaturan etalase berhasil disimpan!');
    }

    /**
     * Toggle store active status.
     */
    public function toggleActive(Request $request): RedirectResponse
    {
        $store = $request->user()->store;

        if (!$store) {
            return redirect()->route('seller.onboarding');
        }

        $store->update(['is_active' => !$store->is_active]);

        $status = $store->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "Etalase berhasil {$status}!");
    }
}

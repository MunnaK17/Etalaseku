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

        return view('seller.store.edit', compact('store'));
    }

    /**
     * Update the store settings.
     */
    public function update(StoreRequest $request, Store $store): RedirectResponse
    {
        // Ensure user owns this store
        if ($store->user_id !== $request->user()->id) {
            abort(403);
        }

        $store->update($request->validated());

        return redirect()
            ->route('seller.store.edit')
            ->with('success', 'Pengaturan etalase berhasil disimpan!');
    }

    /**
     * Toggle store active status.
     */
    public function toggleActive(Request $request, Store $store): RedirectResponse
    {
        if ($store->user_id !== $request->user()->id) {
            abort(403);
        }

        $store->update(['is_active' => !$store->is_active]);

        $status = $store->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return redirect()
            ->back()
            ->with('success', "Etalase berhasil {$status}!");
    }
}

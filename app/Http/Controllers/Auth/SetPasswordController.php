<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class SetPasswordController extends Controller
{
    /**
     * Display the set password form.
     */
    public function showForm(): View
    {
        return view('auth.set-password');
    }

    /**
     * Handle setting the user's password.
     */
    public function setPassword(Request $request): RedirectResponse
    {
        $user = $request->user();

        // Only allow Google users to set password through this route
        if (!$user || !$user->isGoogleUser()) {
            return redirect()
                ->route('profile.edit')
                ->with('error', 'Hanya pengguna Google yang dapat menggunakan fitur ini.');
        }

        $validated = $request->validate([
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('status', 'google-password-set');
    }
}

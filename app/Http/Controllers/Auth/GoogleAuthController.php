<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to Google OAuth.
     */
    public function redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback.
     */
    public function callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Login Google gagal. Silakan coba lagi.']);
        }

        if (!$googleUser->getEmail()) {
            return redirect()
                ->route('login')
                ->withErrors(['email' => 'Akun Google tidak mengirimkan email.']);
        }

        $user = User::firstOrCreate(
            ['email' => strtolower($googleUser->getEmail())],
            [
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'password' => Hash::make(Str::random(40)),
                'email_verified_at' => now(),
                'role' => 'user',
            ]
        );

        if (!$user->email_verified_at) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        Auth::login($user, true);

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard'));
        }

        if (!$user->hasStore()) {
            return redirect()->route('seller.onboarding');
        }

        return redirect()->intended(route('seller.dashboard'));
    }
}

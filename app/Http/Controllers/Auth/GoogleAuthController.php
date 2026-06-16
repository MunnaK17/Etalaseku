<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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

        $email = strtolower($googleUser->getEmail());
        $googleId = $googleUser->getId();
        $avatar = $googleUser->getAvatar();

        // Find existing user by email
        $user = User::where('email', $email)->first();

        if ($user) {
            // User exists - update google_id and avatar if needed
            $user->forceFill([
                'google_id' => $googleId,
                'avatar' => $avatar,
                'email_verified_at' => $user->email_verified_at ?? now(),
            ])->save();
        } else {
            // Create new user with Google OAuth data
            // Password is NULL for Google users - they must set password to login manually
            $user = User::create([
                'name' => $googleUser->getName() ?: $googleUser->getNickname() ?: 'Google User',
                'email' => $email,
                'password' => null, // NULL for Google users
                'google_id' => $googleId,
                'avatar' => $avatar,
                'email_verified_at' => now(),
                'role' => 'user',
            ]);
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

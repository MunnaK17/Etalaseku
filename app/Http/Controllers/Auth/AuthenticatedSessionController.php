<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request): View
    {
        $left = random_int(1, 9);
        $right = random_int(1, 9);

        $request->session()->put('login_math_question', "{$left} + {$right}");
        $request->session()->put('login_math_answer', $left + $right);

        return view('auth.login', [
            'mathQuestion' => $request->session()->get('login_math_question'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $request->session()->forget(['login_math_question', 'login_math_answer']);

        // Check if user has a store, redirect to onboarding if not
        $user = $request->user();

        // Check if user's store is suspended
        if ($user && $user->store && $user->store->is_suspended) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('error', 'Akun Anda ditangguhkan. Hubungi admin untuk informasi lebih lanjut.');
        }

        if ($user && $user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user && !$user->hasStore()) {
            return redirect()->route('seller.onboarding');
        }

        return redirect()->intended(route('seller.dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

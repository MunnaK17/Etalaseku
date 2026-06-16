<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        if (!$request->user()) {
            return redirect()->route('login');
        }

        $user = $request->user();

        // Check if user is admin
        if (!$user->isAdmin()) {
            abort(403, 'Access denied. Admin only.');
        }

        // Check if user's store is suspended (prevent admin access if suspended)
        if ($user->store && $user->store->is_suspended) {
            // Log out the user
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('login')
                ->with('error', 'Akun Anda ditangguhkan. Hubungi admin untuk informasi lebih lanjut.');
        }

        return $next($request);
    }
}

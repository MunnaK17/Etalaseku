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

        // Check for admin email or role
        $user = $request->user();

        // Allow specific admin emails or users with admin role
        $adminEmails = [
            'admin@etalaseku.test',
            'admin@etalaseku.com',
        ];

        if (in_array(strtolower($user->email), array_map('strtolower', $adminEmails))) {
            return $next($request);
        }

        // Check for admin role
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Deny access
        abort(403, 'Access denied. Admin only.');
    }
}

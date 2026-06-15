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

        if ($user->isAdmin()) {
            return $next($request);
        }

        // Deny access
        abort(403, 'Access denied. Admin only.');
    }
}

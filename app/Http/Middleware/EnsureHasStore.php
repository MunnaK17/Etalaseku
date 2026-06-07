<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureHasStore
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has a store
        if ($request->user() && !$request->user()->hasStore()) {
            // Allow access to onboarding and store creation routes
            if (!$this->isAllowedRoute($request)) {
                return redirect()->route('seller.onboarding');
            }
        }

        return $next($request);
    }

    /**
     * Check if the current route is allowed without a store.
     */
    protected function isAllowedRoute(Request $request): bool
    {
        $allowedRoutes = [
            'seller.onboarding',
            'seller.store.store', // Store creation
            'logout',
        ];

        return in_array($request->route()?->getName(), $allowedRoutes);
    }
}

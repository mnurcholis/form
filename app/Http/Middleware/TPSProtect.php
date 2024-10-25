<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TPSProtect
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user->hasRole('super-admin')) {
            return $next($request); // Allow superadmin to access any route
        }

        // Check if the user has the role 'admin-tps' or 'tps'
        if ($user->hasRole(['admin-tps', 'tps'])) {
            // Check if the current route is one of the allowed routes
            if ($request->routeIs('dashboard-tps') || $request->routeIs('pendaftaran-tps') || $request->routeIs('tps')) {
                return $next($request); // Allow access to the route
            }
            // If the route is not allowed, redirect to dashboard-tps or another fallback
            return redirect()->route('dashboard-tps');
        }

        // If the user doesn't have the correct role, deny access
        abort(403, 'Unauthorized');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GantiPassword
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

            if ($user->status == 0) {
                return redirect()->to('ganti-password');
            }
        }
        return $next($request);
        // If the user doesn't have the correct role, deny access
        abort(403, 'Unauthorized');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     * Restricts access to authenticated users with Admin or Editor role.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (! $user) {
            return redirect()->route('admin.login')
                ->with('error', 'Please login to continue.');
        }

        if (! $user->is_active) {
            Auth::logout();
            $request->session()->invalidate();
            return redirect()->route('admin.login')
                ->with('error', 'Your account has been deactivated.');
        }

        if (! $user->hasAnyRole(['Admin', 'Editor'])) {
            abort(403, 'You do not have permission to access the admin panel.');
        }

        return $next($request);
    }
}

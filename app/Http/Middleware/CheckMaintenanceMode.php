<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Setting;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        $setting = Setting::instance();
        
        if ($setting->maintenance_mode) {
            // Check if user is admin
            if (!$request->user() || !$request->user()->hasRole('Admin')) {
                if ($request->expectsJson()) {
                    return response()->json(['message' => 'Site is under maintenance.'], 503);
                }
                return response()->view('front.coming-soon', [], 503);
            }
        }
        
        return $next($request);
    }
}

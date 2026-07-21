<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Setting;
use Symfony\Component\HttpFoundation\Response;

class LanguageManager
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get locale from session or cookie
        $locale = $request->session()->get('locale') 
            ?? $request->cookie('locale')
            ?? Setting::getDefaultLanguage();

        // Validate locale
        $availableLocales = ['en', 'bn'];
        if (!in_array($locale, $availableLocales)) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        // Store in session
        $request->session()->put('locale', $locale);

        return $next($request);
    }
}

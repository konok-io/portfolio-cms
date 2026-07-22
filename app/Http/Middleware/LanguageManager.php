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
        // Get locale from session, cookie, or URL parameter
        $locale = $request->get('lang')
            ?? $request->session()->get('locale')
            ?? $request->cookie('locale')
            ?? Setting::getDefaultLanguage();

        // Validate locale (supported: en, bn, ar)
        $availableLocales = ['en', 'bn', 'ar'];
        if (!in_array($locale, $availableLocales)) {
            $locale = 'en';
        }

        app()->setLocale($locale);

        // Store in session and cookie
        $request->session()->put('locale', $locale);
        
        // Set cookie for 1 year
        cookie()->queue('locale', $locale, 60 * 24 * 365);

        return $next($request);
    }
}

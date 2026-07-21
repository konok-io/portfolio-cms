<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LanguageController extends Controller
{
    /**
     * Switch application language
     */
    public function switch(string $locale): \Illuminate\Http\RedirectResponse
    {
        $availableLocales = ['en', 'bn'];

        if (!in_array($locale, $availableLocales)) {
            $locale = 'en';
        }

        // Store in session
        session(['locale' => $locale]);

        // Set cookie for persistence
        $response = redirect()->back();
        $response->withCookie(cookie('locale', $locale, 60 * 24 * 365)); // 1 year

        return $response;
    }
}

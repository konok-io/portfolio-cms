<?php

namespace App\Helpers;

use App\Models\Setting;
use Illuminate\Support\Facades\App;

class TranslationHelper
{
    /**
     * Get translation for a key
     */
    public static function get(string $key, string $fallback = null): string
    {
        $locale = self::getCurrentLocale();
        $keyParts = explode('.', $key);
        
        // Try loading from lang files
        $translation = self::loadTranslation($locale, $keyParts);
        
        if ($translation !== null) {
            return $translation;
        }
        
        // Fallback to English
        if ($locale !== 'en') {
            $translation = self::loadTranslation('en', $keyParts);
            if ($translation !== null) {
                return $translation;
            }
        }
        
        // Return the key itself or custom fallback
        return $fallback ?? ucfirst(str_replace('_', ' ', last($keyParts)));
    }
    
    /**
     * Load translation from lang file
     */
    protected static function loadTranslation(string $locale, array $keyParts): ?string
    {
        $group = array_shift($keyParts);
        $langPath = lang_path("{$locale}/common.php");
        
        if (!file_exists($langPath)) {
            return null;
        }
        
        $translations = require $langPath;
        $value = self::getNestedValue($translations, $keyParts);
        
        return is_string($value) ? $value : null;
    }
    
    /**
     * Get nested value from array
     */
    protected static function getNestedValue(array $array, array $keys): mixed
    {
        foreach ($keys as $key) {
            if (!is_array($array) || !array_key_exists($key, $array)) {
                return null;
            }
            $array = $array[$key];
        }
        return $array;
    }
    
    /**
     * Get current locale
     */
    public static function getCurrentLocale(): string
    {
        // Check if user has a saved preference
        if (session()->has('locale')) {
            return session('locale');
        }
        
        // Check GTranslate cookie
        if (request()->cookie('googtrans')) {
            $match = request()->cookie('googtrans');
            if (preg_match('/\/([a-z-]+)$/', $match, $matches)) {
                $locale = $matches[1];
                // Convert to simple language code
                $locale = explode('-', $locale)[0];
                if (in_array($locale, self::getSupportedLocales())) {
                    return $locale;
                }
            }
        }
        
        // Check browser language
        $browserLang = request()->getPreferredLanguage();
        if ($browserLang) {
            $locale = explode('-', $browserLang)[0];
            if (in_array($locale, self::getSupportedLocales())) {
                return $locale;
            }
        }
        
        // Fallback to settings or default
        try {
            $setting = Setting::instance();
            return $setting->default_language ?? 'en';
        } catch (\Exception $e) {
            return 'en';
        }
    }
    
    /**
     * Get supported locales
     */
    public static function getSupportedLocales(): array
    {
        return ['en', 'bn', 'ar'];
    }

    /**
     * Get locale display name
     */
    public static function getLocaleName(string $locale): string
    {
        $names = [
            'en' => 'English',
            'bn' => 'বাংলা',
            'ar' => 'العربية',
        ];
        return $names[$locale] ?? $locale;
    }

    /**
     * Get locale native name
     */
    public static function getLocaleNativeName(string $locale): string
    {
        $names = [
            'en' => 'English',
            'bn' => 'বাংলা',
            'ar' => 'العربية',
        ];
        return $names[$locale] ?? $locale;
    }
    
    /**
     * Set locale
     */
    public static function setLocale(string $locale): void
    {
        if (in_array($locale, self::getSupportedLocales())) {
            App::setLocale($locale);
            session(['locale' => $locale]);
        }
    }
    
    /**
     * Check if locale is RTL
     */
    public static function isRtl(): bool
    {
        $locale = self::getCurrentLocale();
        return in_array($locale, ['ar', 'ur', 'he', 'fa']);
    }
    
    /**
     * Get locale direction
     */
    public static function getDirection(): string
    {
        return self::isRtl() ? 'rtl' : 'ltr';
    }
}

<?php

use App\Models\GeneralSetting;
use App\Models\Translation;
use App\Models\Setting;

if (!function_exists('settings')) {
    function settings(string $key, $default = null)
    {
        return GeneralSetting::getSetting($key, $default);
    }
}

if (!function_exists('__')) {
    /**
     * Get translated string or fallback to key
     */
    function __(string $key, array $replace = [], ?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();
        $group = 'messages';
        
        $line = lang($group . '.' . $key, $locale);
        
        if ($line === $group . '.' . $key) {
            // Try English fallback
            if ($locale !== 'en') {
                $line = lang($group . '.' . $key, 'en');
            }
            if ($line === $group . '.' . $key) {
                return $key;
            }
        }
        
        foreach ($replace as $placeholder => $value) {
            $line = str_replace(':' . $placeholder, $value, $line);
        }
        
        return $line;
    }
}

if (!function_exists('get_trans')) {
    /**
     * Get content translation for an entity
     */
    function get_trans(string $group, int $entityId, string $key, ?string $default = null): ?string
    {
        $locale = app()->getLocale();
        return Translation::getTranslation($group, $entityId, $locale, $key, $default);
    }
}

if (!function_exists('set_trans')) {
    /**
     * Set content translation for an entity
     */
    function set_trans(string $group, int $entityId, string $locale, string $key, ?string $value): void
    {
        Translation::setTranslation($group, $entityId, $locale, $key, $value);
    }
}

if (!function_exists('current_language')) {
    /**
     * Get current language code
     */
    function current_language(): string
    {
        return app()->getLocale() ?? Setting::getDefaultLanguage();
    }
}

if (!function_exists('available_languages')) {
    /**
     * Get available languages
     */
    function available_languages(): array
    {
        return [
            'en' => 'English',
            'bn' => 'বাংলা',
        ];
    }
}

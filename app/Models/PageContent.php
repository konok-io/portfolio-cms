<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;

class PageContent
{
    private static ?array $content = null;

    /**
     * Get all page content from settings
     */
    public static function all(): array
    {
        if (self::$content !== null) {
            return self::$content;
        }

        $setting = Setting::instance();
        self::$content = $setting->page_content ?? self::getDefaultContent();
        
        return self::$content;
    }

    /**
     * Get content for a specific page and key
     */
    public static function get(string $page, string $key, ?string $locale = null): ?string
    {
        $content = self::all();
        $locale = $locale ?? app()->getLocale() ?? 'en';
        
        $pageContent = $content[$page] ?? [];
        
        // Try locale-specific key first
        $localeKey = "{$key}_{$locale}";
        if (isset($pageContent[$localeKey])) {
            return $pageContent[$localeKey];
        }
        
        // Try default key
        if (isset($pageContent[$key])) {
            return $pageContent[$key];
        }
        
        // Return null (will fallback to hardcoded text)
        return null;
    }

    /**
     * Set content for a specific page and key
     */
    public static function set(string $page, string $key, array $values): void
    {
        $setting = Setting::instance();
        $content = $setting->page_content ?? [];
        
        // Store with locale suffixes
        foreach ($values as $locale => $value) {
            $content[$page]["{$key}_{$locale}"] = $value;
        }
        
        // Also set default
        $content[$page][$key] = $values['default'] ?? $values['en'] ?? '';
        
        $setting->page_content = $content;
        $setting->save();
        
        // Clear cache
        self::$content = null;
        Cache::forget('settings');
    }

    /**
     * Get all content for a page
     */
    public static function getPage(string $page): array
    {
        $content = self::all();
        return $content[$page] ?? [];
    }

    /**
     * Set all content for a page
     */
    public static function setPage(string $page, array $values): void
    {
        $setting = Setting::instance();
        $content = $setting->page_content ?? [];
        $content[$page] = $values;
        $setting->page_content = $content;
        $setting->save();
        
        // Clear cache
        self::$content = null;
        Cache::forget('settings');
    }

    /**
     * Clear content cache
     */
    public static function clearCache(): void
    {
        self::$content = null;
        Cache::forget('settings');
    }

    /**
     * Get default content structure
     */
    public static function getDefaultContent(): array
    {
        return [
            'home' => [
                // Hero Section
                'hero_eyebrow' => 'Available for new projects',
                'hero_eyebrow_en' => 'Available for new projects',
                'hero_eyebrow_bn' => 'নতুন প্রজেক্টের জন্য উপলব্ধ',
                'hero_eyebrow_ar' => 'متاح لمشاريع جديدة',
                
                // Contact Section
                'contact_eyebrow' => 'Get In Touch',
                'contact_title' => "Let's build something great together",
                'contact_text' => 'Have a project in mind? Fill out the form and I\'ll get back to you shortly.',
            ],
            'footer' => [
                'tagline' => 'Building thoughtful, modern web experiences — from idea to launch.',
                'copyright' => 'All rights reserved.',
            ],
            'contact' => [
                'title' => "Let's Work Together",
                'subtitle' => 'Have a project in mind? Fill out the form below and I\'ll get back to you within 24 hours.',
            ],
            'blog' => [
                'title' => 'Latest Articles & Insights',
                'subtitle' => 'Thoughts on web development, Laravel, and building better software.',
            ],
            'portfolio' => [
                'title' => 'All Projects',
                'subtitle' => 'Browse through a complete collection of my recent work.',
            ],
            'services' => [
                'title' => 'Services',
                'subtitle' => 'End-to-end web development services to help your idea reach production.',
            ],
            'about' => [
                'title' => 'About Me',
                'subtitle' => 'Get to know me better',
            ],
        ];
    }
}

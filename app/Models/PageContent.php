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
     * Get all content for a specific page
     */
    public static function getPage(string $page): array
    {
        $content = self::all();
        return $content[$page] ?? self::getDefaultPageContent($page);
    }

    /**
     * Get default content for a specific page
     */
    private static function getDefaultPageContent(string $page): array
    {
        $defaults = [
            'resume' => [
                'title' => ['en' => 'My Resume', 'default' => 'My Resume'],
                'subtitle' => ['en' => 'A comprehensive overview of my skills, experience, and achievements', 'default' => 'A comprehensive overview of my skills, experience, and achievements'],
                'eyebrow' => ['en' => 'My Resume', 'default' => 'My Resume'],
            ],
            'faq' => [
                'title' => ['en' => 'FAQ', 'default' => 'FAQ'],
                'subtitle' => ['en' => 'Find answers to frequently asked questions', 'default' => 'Find answers to frequently asked questions'],
            ],
            'pricing' => [
                'title' => ['en' => 'Pricing', 'default' => 'Pricing'],
                'subtitle' => ['en' => 'Transparent pricing for your projects', 'default' => 'Transparent pricing for your projects'],
            ],
        ];

        return $defaults[$page] ?? [
            'title' => ['en' => ucfirst($page), 'default' => ucfirst($page)],
            'subtitle' => ['en' => '', 'default' => ''],
            'eyebrow' => ['en' => ucfirst($page), 'default' => ucfirst($page)],
        ];
    }

    /**
     * Get content for a specific page and key
     */
    public static function get(string $page, string $key, ?string $locale = null): ?string
    {
        $content = self::all();
        $locale = $locale ?? app()->getLocale() ?? 'en';

        // Check if page exists
        if (!isset($content[$page])) {
            return null;
        }
        
        $pageContent = $content[$page];
        
        // If key exists directly at page level
        if (isset($pageContent[$key])) {
            $value = $pageContent[$key];
            if (is_array($value)) {
                return $value[$locale] ?? $value['default'] ?? $value['en'] ?? null;
            }
            return $value;
        }
        
        // Search in nested sections (section.field format)
        foreach ($pageContent as $sectionData) {
            if (is_array($sectionData) && isset($sectionData[$key])) {
                $value = $sectionData[$key];
                if (is_array($value)) {
                    return $value[$locale] ?? $value['default'] ?? $value['en'] ?? null;
                }
                return $value;
            }
        }
        
        // Debug: log what keys are available
        \Log::debug("PageContent: Key not found", [
            'page' => $page,
            'key' => $key,
            'locale' => $locale,
            'available_keys' => array_keys($pageContent)
        ]);

        return null;
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
            'footer' => [
                'tagline' => 'Building thoughtful, modern web experiences — from idea to launch.',
                'copyright_prefix' => 'Built with Laravel',
            ],
        ];
    }
}

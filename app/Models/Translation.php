<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Translation extends Model
{
    protected $table = 'translations';

    protected $fillable = [
        'group',
        'entity_id',
        'locale',
        'key',
        'value',
    ];

    /**
     * Get translation for a specific entity
     */
    public static function getTranslation(string $group, int $entityId, string $locale, string $key, ?string $default = null): ?string
    {
        $cacheKey = "translation_{$group}_{$entityId}_{$locale}_{$key}";

        return Cache::remember($cacheKey, now()->addDay(), function () use ($group, $entityId, $locale, $key, $default) {
            $translation = static::where('group', $group)
                ->where('entity_id', $entityId)
                ->where('locale', $locale)
                ->where('key', $key)
                ->first();

            return $translation?->value ?? $default;
        });
    }

    /**
     * Get all translations for an entity
     */
    public static function getEntityTranslations(string $group, int $entityId, string $locale): array
    {
        return Cache::remember("translations_{$group}_{$entityId}_{$locale}", now()->addDay(), function () use ($group, $entityId, $locale) {
            return static::where('group', $group)
                ->where('entity_id', $entityId)
                ->where('locale', $locale)
                ->pluck('value', 'key')
                ->toArray();
        });
    }

    /**
     * Set translation for an entity
     */
    public static function setTranslation(string $group, int $entityId, string $locale, string $key, ?string $value): void
    {
        static::updateOrCreate(
            [
                'group' => $group,
                'entity_id' => $entityId,
                'locale' => $locale,
                'key' => $key,
            ],
            ['value' => $value]
        );

        // Clear cache
        Cache::forget("translation_{$group}_{$entityId}_{$locale}_{$key}");
        Cache::forget("translations_{$group}_{$entityId}_{$locale}");
    }

    /**
     * Delete all translations for an entity
     */
    public static function deleteEntityTranslations(string $group, int $entityId): void
    {
        static::where('group', $group)
            ->where('entity_id', $entityId)
            ->delete();

        Cache::flush();
    }
}

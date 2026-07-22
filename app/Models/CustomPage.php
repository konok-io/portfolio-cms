<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CustomPage extends Model
{
    use HasFactory;

    protected $table = 'custom_pages';

    protected $fillable = [
        'title',
        'slug',
        'template',
        'content',
        'meta_title',
        'meta_description',
        'is_published',
        'show_in_footer',
        'show_in_header',
        'show_site_header',
        'show_site_footer',
        'sort_order',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'show_in_footer' => 'boolean',
        'show_in_header' => 'boolean',
        'show_site_header' => 'boolean',
        'show_site_footer' => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    /**
     * Get published pages
     */
    public static function getPublished()
    {
        return static::where('is_published', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get footer pages
     */
    public static function getFooterPages()
    {
        return static::where('is_published', true)
            ->where('show_in_footer', true)
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Get header pages
     */
    public static function getHeaderPages()
    {
        return static::where('is_published', true)
            ->where('show_in_header', true)
            ->orderBy('sort_order')
            ->get();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

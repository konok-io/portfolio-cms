<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'title',
        'slug',
        'project_category_id',
        'featured_image',
        'alt_text',
        'client_name',
        'project_url',
        'video_url',
        'technologies',
        'description',
        'status',
        'is_featured',
        'is_active',
        'sort_order',
        'view_count',
        'download_count',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer',
            'view_count'  => 'integer',
            'download_count' => 'integer',
        ];
    }
    
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
    }
    
    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
    }

    protected static function booted(): void
    {
        static::creating(function (Project $project) {
            if (empty($project->slug)) {
                $project->slug = static::generateUniqueSlug($project->title);
            }
        });
    }

    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug     = Str::slug($title);
        $original = $slug;
        $i        = 1;

        while (
            static::where('slug', $slug)
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }

    public function category()
    {
        return $this->belongsTo(ProjectCategory::class, 'project_category_id');
    }

    public function gallery()
    {
        return $this->hasMany(ProjectGallery::class)->orderBy('sort_order');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tag');
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->featured_image ? asset('storage/' . $this->featured_image) : null;
    }

    public function getTechnologiesArrayAttribute(): array
    {
        return $this->technologies
            ? array_map('trim', explode(',', $this->technologies))
            : [];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function scopeByTag($query, $tagSlug)
    {
        return $query->whereHas('tags', function ($q) use ($tagSlug) {
            $q->where('slug', $tagSlug);
        });
    }
    
    public function hasVideo(): bool
    {
        return !empty($this->video_url);
    }
    
    public function getVideoEmbedUrl(): ?string
    {
        if (!$this->video_url) {
            return null;
        }
        
        // YouTube
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches)) {
            return 'https://www.youtube.com/embed/' . $matches[1];
        }
        
        // Vimeo
        if (preg_match('/vimeo\.com\/(\d+)/', $this->video_url, $matches)) {
            return 'https://player.vimeo.com/video/' . $matches[1];
        }
        
        return $this->video_url;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}

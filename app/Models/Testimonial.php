<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $table = 'testimonials';

    protected $fillable = [
        'client_name',
        'company',
        'photo',
        'video_url',
        'rating',
        'review',
        'is_active',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active'  => 'boolean',
            'rating'     => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->client_name) . '&background=2563EB&color=fff';
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

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    /**
     * Projects with this tag
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class, 'project_tag');
    }

    /**
     * Blogs with this tag
     */
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag');
    }

    /**
     * Get all tags
     */
    public static function getAll()
    {
        return static::orderBy('name', 'ASC')->get();
    }

    /**
     * Get popular tags
     */
    public static function getPopular($limit = 10)
    {
        return static::withCount(['projects', 'blogs'])
            ->orderBy('projects_count', 'desc')
            ->orderBy('blogs_count', 'desc')
            ->limit($limit)
            ->get();
    }
}

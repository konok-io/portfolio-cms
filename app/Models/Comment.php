<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    protected $fillable = [
        'blog_id',
        'name',
        'email',
        'website',
        'comment',
        'is_approved',
        'parent_id',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    public function blog(): BelongsTo
    {
        return $this->belongsTo(Blog::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('is_approved', true);
    }

    public function scopeForBlog($query, $blogId)
    {
        return $query->where('blog_id', $blogId);
    }

    public function scopeRootComments($query)
    {
        return $query->whereNull('parent_id');
    }

    public function approve(): void
    {
        $this->update(['is_approved' => true]);
    }

    public function reject(): void
    {
        $this->update(['is_approved' => false]);
    }
}

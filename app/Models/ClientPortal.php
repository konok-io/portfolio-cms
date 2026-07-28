<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ClientPortal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'project_name',
        'project_token',
        'status',
        'progress',
        'notes',
        'deadline',
        'files',
    ];

    protected $casts = [
        'files' => 'array',
        'deadline' => 'date',
        'progress' => 'decimal:1',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($portal) {
            if (empty($portal->project_token)) {
                $portal->project_token = Str::random(64);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeByToken($query, $token)
    {
        return $query->where('project_token', $token);
    }

    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'in_progress' => 'In Progress',
            'review' => 'Under Review',
            'completed' => 'Completed',
            'on_hold' => 'On Hold',
            default => 'Unknown',
        };
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'in_progress' => 'primary',
            'review' => 'warning',
            'completed' => 'success',
            'on_hold' => 'secondary',
            default => 'secondary',
        };
    }

    public function addFile($name, $url, $type = 'link')
    {
        $files = $this->files ?? [];
        $files[] = [
            'name' => $name,
            'url' => $url,
            'type' => $type,
            'uploaded_at' => now()->toISOString(),
        ];
        $this->files = $files;
        $this->save();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'route',
        'icon',
        'position',
        'is_active',
        'target',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'position' => 'integer',
    ];

    public static function getActiveMenuItems()
    {
        return static::where('is_active', true)
            ->orderBy('position')
            ->get();
    }

    public function getLinkAttribute(): string
    {
        if ($this->route) {
            return route($this->route);
        }
        return $this->url ?? '#';
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('position');
    }
}

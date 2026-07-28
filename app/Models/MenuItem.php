<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'route',
        'icon',
        'order',
        'is_active',
        'target',
        'parent_id',
        'sort_order',
        'menu_type',
        'has_children',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order' => 'integer',
        'sort_order' => 'integer',
        'has_children' => 'boolean',
    ];

    // Relationships
    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function allChildren(): HasMany
    {
        return $this->children()->with('allChildren');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOfType($query, string $type)
    {
        return $query->where('menu_type', $type);
    }

    // Get URL/link
    public function getLinkAttribute(): string
    {
        if ($this->route) {
            try {
                return route($this->route);
            } catch (\Exception $e) {
                return $this->url ?? '#';
            }
        }
        return $this->url ?? '#';
    }

    // Static methods for getting menu items
    public static function getActiveMenuItems(string $type = 'header'): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)
            ->where('menu_type', $type)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('allChildren')
            ->get();
    }

    // Build tree structure
    public static function buildTree(\Illuminate\Database\Eloquent\Collection $items): array
    {
        $grouped = $items->groupBy('parent_id');
        
        return $grouped->get(null, collect())->map(function ($item) use ($grouped) {
            $item->setRelation('children', $grouped->get($item->id, collect()));
            return $item;
        })->toArray();
    }
}

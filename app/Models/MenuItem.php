<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';
    
    protected $fillable = [
        'title',
        'url',
        'target',
        'icon',
        'position',
        'is_active',
    ];
    
    public static function getNavigationMenu(): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('is_active', true)
            ->orderBy('position')
            ->get();
    }
}

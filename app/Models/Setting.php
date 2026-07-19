<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'site_name',
        'logo',
        'header_display',
        'favicon',
        'email',
        'phone',
        'address',
        'google_map',
        'facebook',
        'twitter',
        'linkedin',
        'github',
        'instagram',
        'youtube',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1], ['site_name' => 'Portfolio CMS']);
    }

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon ? asset('storage/' . $this->favicon) : null;
    }
}

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
        'default_language',
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
        'maintenance_mode',
        'recaptcha_site_key',
        'recaptcha_secret_key',
        'recaptcha_enabled',
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

    public static function getDefaultLanguage(): string
    {
        return static::instance()->default_language ?? 'en';
    }
    
    public function isRecaptchaEnabled(): bool
    {
        return $this->recaptcha_enabled && !empty($this->recaptcha_site_key) && !empty($this->recaptcha_secret_key);
    }
}

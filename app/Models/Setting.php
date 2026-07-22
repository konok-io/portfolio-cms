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
        'mail_driver',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'google_analytics_id',
        'google_tag_manager_id',
        'analytics_enabled',
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

    public function isAnalyticsEnabled(): bool
    {
        return $this->analytics_enabled && (
            !empty($this->google_analytics_id) || !empty($this->google_tag_manager_id)
        );
    }

    public function getGoogleAnalyticsId(): ?string
    {
        return $this->analytics_enabled ? $this->google_analytics_id : null;
    }

    public function getGoogleTagManagerId(): ?string
    {
        return $this->analytics_enabled ? $this->google_tag_manager_id : null;
    }

    public function applyMailConfig(): void
    {
        config([
            'mail.default' => $this->mail_driver ?? 'smtp',
            'mail.mailers.smtp.host' => $this->mail_host ?? '',
            'mail.mailers.smtp.port' => $this->mail_port ?? 587,
            'mail.mailers.smtp.username' => $this->mail_username ?? '',
            'mail.mailers.smtp.password' => $this->mail_password ?? '',
            'mail.mailers.smtp.encryption' => $this->mail_encryption ?? 'tls',
            'mail.from.address' => $this->mail_from_address ?? $this->email ?? '',
            'mail.from.name' => $this->mail_from_name ?? $this->site_name ?? 'Portfolio CMS',
        ]);
    }
}

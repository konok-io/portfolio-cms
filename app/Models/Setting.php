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
        'whatsapp',
        'whatsapp_number',
        'whatsapp_default_message',
        'tiktok',
        'snapchat',
        'pinterest',
        'reddit',
        'discord',
        'twitch',
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
        'cookie_consent_enabled',
        'cookie_essential_only',
        'cookie_expiry_days',
        '404_title',
        '404_message',
        '404_button_text',
        '404_icon',
        'coming_soon_title',
        'coming_soon_message',
        'coming_soon_date',
        'coming_soon_enabled',
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

    public function getWhatsAppLink(): ?string
    {
        if (empty($this->whatsapp_number)) {
            return null;
        }
        
        // Clean the number (remove spaces, dashes, etc.)
        $number = preg_replace('/[^0-9+]/', '', $this->whatsapp_number);
        
        // Remove leading + if present
        $number = ltrim($number, '+');
        
        // Default message
        $message = $this->whatsapp_default_message ?? 'Hello! I would like to inquire about your services.';
        
        return "https://wa.me/{$number}?text=" . urlencode($message);
    }

    public function isCookieConsentEnabled(): bool
    {
        return $this->cookie_consent_enabled ?? true;
    }

    // 404 Page Helpers
    public function get404Title(): string
    {
        return $this->{'404_title'} ?? 'Page Not Found';
    }

    public function get404Message(): string
    {
        return $this->{'404_message'} ?? 'Oops! The page you\'re looking for doesn\'t exist or has been moved.';
    }

    public function get404ButtonText(): string
    {
        return $this->{'404_button_text'} ?? 'Back to Home';
    }

    public function get404Icon(): string
    {
        return $this->{'404_icon'} ?? 'fa-compass';
    }

    // Coming Soon Page Helpers
    public function isComingSoonEnabled(): bool
    {
        return $this->coming_soon_enabled ?? false;
    }

    public function getComingSoonTitle(): string
    {
        return $this->coming_soon_title ?? 'Coming Soon';
    }

    public function getComingSoonMessage(): string
    {
        return $this->coming_soon_message ?? 'We\'re working on something exciting. Stay tuned!';
    }

    public function getComingSoonDate(): ?\Carbon\Carbon
    {
        return $this->coming_soon_date ? \Carbon\Carbon::parse($this->coming_soon_date) : null;
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

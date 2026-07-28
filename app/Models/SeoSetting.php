<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SeoSetting extends Model
{
    protected $table = 'seo_settings';

    protected $fillable = [
        // General SEO
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_author',
        'meta_language',
        'canonical_url',
        
        // Homepage SEO
        'home_meta_title',
        'home_meta_description',
        'home_meta_keywords',
        
        // Open Graph (Facebook)
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'og_site_name',
        'og_locale',
        
        // Twitter SEO
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_card_type',
        'twitter_site',
        'twitter_creator',
        
        // Search Engine Settings
        'allow_indexing',
        'allow_following',
        'allow_archiving',
        'allow_snippet',
        
        // Verification Codes
        'google_site_verification',
        'bing_site_verification',
        'yandex_verification',
        'pinterest_verification',
        
        // Analytics
        'google_analytics_id',
        'google_tag_manager_id',
        'facebook_pixel_id',
        'microsoft_clarity_id',
        
        // Schema Settings
        'organization_name',
        'organization_logo',
        'organization_phone',
        'organization_email',
        'organization_address',
        
        // Social Links
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'instagram_url',
        'youtube_url',
        
        // Technical SEO
        'robots_txt_content',
        'custom_head_code',
        'custom_body_code',
        
        // XML Sitemap
        'sitemap_enabled',
        'sitemap_url',
    ];

    protected $casts = [
        'allow_indexing' => 'boolean',
        'allow_following' => 'boolean',
        'allow_archiving' => 'boolean',
        'allow_snippet' => 'boolean',
        'sitemap_enabled' => 'boolean',
    ];

    public static function instance(): self
    {
        return static::firstOrCreate(['id' => 1]);
    }

    public function getOgImageUrlAttribute(): ?string
    {
        return $this->og_image ? asset('storage/' . $this->og_image) : null;
    }

    public function getTwitterImageUrlAttribute(): ?string
    {
        return $this->twitter_image ? asset('storage/' . $this->twitter_image) : null;
    }

    public function getOrganizationLogoUrlAttribute(): ?string
    {
        return $this->organization_logo ? asset('storage/' . $this->organization_logo) : null;
    }

    public function getSiteUrl(): string
    {
        return config('app.url', request()->getSchemeAndHttpHost());
    }

    public function getDefaultRobotsTxt(): string
    {
        $siteUrl = $this->getSiteUrl();
        $sitemapUrl = $this->sitemap_enabled ? $siteUrl . '/sitemap.xml' : '';
        
        $content = "User-agent: *\n";
        $content .= "Allow: /\n\n";
        
        if ($sitemapUrl) {
            $content .= "Sitemap: {$sitemapUrl}\n";
        }
        
        return $content;
    }

    public function getRobotsTxt(): string
    {
        return $this->robots_txt_content ?? $this->getDefaultRobotsTxt();
    }

    public function getMetaTitle(?string $fallback = null): string
    {
        return $this->meta_title ?? $fallback ?? config('app.name', 'Portfolio CMS');
    }

    public function getMetaDescription(?string $fallback = null): string
    {
        return $this->meta_description ?? $fallback ?? '';
    }

    public function getOgTitle(?string $fallback = null): string
    {
        return $this->og_title ?? $fallback ?? $this->getMetaTitle($fallback);
    }

    public function getOgDescription(?string $fallback = null): string
    {
        return $this->og_description ?? $fallback ?? $this->getMetaDescription($fallback);
    }

    public function getOgImage(?string $fallback = null): ?string
    {
        if ($this->og_image) {
            return asset('storage/' . $this->og_image);
        }
        return $fallback;
    }

    public function getTwitterTitle(?string $fallback = null): string
    {
        return $this->twitter_title ?? $fallback ?? $this->getMetaTitle($fallback);
    }

    public function getTwitterDescription(?string $fallback = null): string
    {
        return $this->twitter_description ?? $fallback ?? $this->getMetaDescription($fallback);
    }

    public function getTwitterImage(?string $fallback = null): ?string
    {
        if ($this->twitter_image) {
            return asset('storage/' . $this->twitter_image);
        }
        return $fallback;
    }

    public function getTwitterCardType(): string
    {
        return $this->twitter_card_type ?? 'summary_large_image';
    }

    public function getOgType(): string
    {
        return $this->og_type ?? 'website';
    }

    public function getOgLocale(): string
    {
        return $this->og_locale ?? 'en_US';
    }

    public function getOgSiteName(): string
    {
        return $this->og_site_name ?? config('app.name', 'Portfolio CMS');
    }

    public function shouldIndex(): bool
    {
        return $this->allow_indexing ?? true;
    }

    public function shouldFollow(): bool
    {
        return $this->allow_following ?? true;
    }

    public function getRobotsDirectives(): string
    {
        $directives = [];
        
        if (!$this->shouldIndex()) {
            $directives[] = 'noindex';
        }
        
        if (!$this->shouldFollow()) {
            $directives[] = 'nofollow';
        }
        
        if (!$this->allow_archiving) {
            $directives[] = 'noarchive';
        }
        
        if (!$this->allow_snippet) {
            $directives[] = 'nosnippet';
        }
        
        return implode(', ', $directives);
    }

    public function getGoogleAnalyticsScript(): ?string
    {
        if (empty($this->google_analytics_id)) {
            return null;
        }
        
        return <<<HTML
<!-- Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id={$this->google_analytics_id}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{$this->google_analytics_id}');
</script>
HTML;
    }

    public function getGoogleTagManagerScript(): ?string
    {
        if (empty($this->google_tag_manager_id)) {
            return null;
        }
        
        return <<<HTML
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{$this->google_tag_manager_id}');</script>
HTML;
    }

    public function getFacebookPixelScript(): ?string
    {
        if (empty($this->facebook_pixel_id)) {
            return null;
        }
        
        return <<<HTML
<!-- Facebook Pixel -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '{$this->facebook_pixel_id}');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id={$this->facebook_pixel_id}&ev=PageView&noscript=1"/></noscript>
HTML;
    }

    public function getMicrosoftClarityScript(): ?string
    {
        if (empty($this->microsoft_clarity_id)) {
            return null;
        }
        
        return <<<HTML
<!-- Microsoft Clarity -->
<script type="text/javascript">
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||[];c[a].push({"projectId":a});
        c[a].push({"property":"{$this->microsoft_clarity_id}","coveo":""});
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i+"?coveo="+a;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "{$this->microsoft_clarity_id}");
</script>
HTML;
    }

    public function getCustomHeadCode(): ?string
    {
        return $this->custom_head_code;
    }

    public function getCustomBodyCode(): ?string
    {
        return $this->custom_body_code;
    }

    public function getVerificationMetaTags(): string
    {
        $tags = [];
        
        if ($this->google_site_verification) {
            $tags[] = '<meta name="google-site-verification" content="' . e($this->google_site_verification) . '">';
        }
        
        if ($this->bing_site_verification) {
            $tags[] = '<meta name="msvalidate.01" content="' . e($this->bing_site_verification) . '">';
        }
        
        if ($this->yandex_verification) {
            $tags[] = '<meta name="yandex-verification" content="' . e($this->yandex_verification) . '">';
        }
        
        if ($this->pinterest_verification) {
            $tags[] = '<meta name="p:domain_verify" content="' . e($this->pinterest_verification) . '">';
        }
        
        return implode("\n", $tags);
    }

    public function generateOrganizationSchema(): ?array
    {
        if (empty($this->organization_name)) {
            return null;
        }
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $this->organization_name,
            'url' => $this->getSiteUrl(),
        ];
        
        if ($this->organization_email) {
            $schema['email'] = $this->organization_email;
        }
        
        if ($this->organization_phone) {
            $schema['telephone'] = $this->organization_phone;
        }
        
        if ($this->organization_address) {
            $schema['address'] = [
                '@type' => 'PostalAddress',
                'addressLocality' => $this->organization_address,
            ];
        }
        
        if ($this->organization_logo) {
            $schema['logo'] = asset('storage/' . $this->organization_logo);
        }
        
        if ($this->facebook_url) {
            $schema['sameAs'][] = $this->facebook_url;
        }
        
        if ($this->twitter_url) {
            $schema['sameAs'][] = $this->twitter_url;
        }
        
        if ($this->linkedin_url) {
            $schema['sameAs'][] = $this->linkedin_url;
        }
        
        if ($this->instagram_url) {
            $schema['sameAs'][] = $this->instagram_url;
        }
        
        if ($this->youtube_url) {
            $schema['sameAs'][] = $this->youtube_url;
        }
        
        return $schema;
    }

    public function generateWebsiteSchema(): array
    {
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $this->getMetaTitle(),
            'url' => $this->getSiteUrl(),
        ];
        
        if ($this->organization_name) {
            $schema['publisher'] = [
                '@type' => 'Organization',
                'name' => $this->organization_name,
            ];
        }
        
        if ($this->canonical_url || $this->shouldIndex()) {
            $schema['potentialAction'] = [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $this->getSiteUrl() . '/search?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ];
        }
        
        return $schema;
    }

    public function generateWebPageSchema(?string $pageUrl = null, ?string $pageTitle = null, ?string $pageDescription = null): array
    {
        $url = $pageUrl ?? $this->getSiteUrl();
        $title = $pageTitle ?? $this->getMetaTitle();
        $description = $pageDescription ?? $this->getMetaDescription();
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'url' => $url,
            'name' => $title,
            'description' => $description,
            'isPartOf' => [
                '@type' => 'WebSite',
                'name' => $this->getMetaTitle(),
                'url' => $this->getSiteUrl(),
            ],
        ];
        
        if ($this->organization_name) {
            $schema['publisher'] = [
                '@type' => 'Organization',
                'name' => $this->organization_name,
            ];
        }
        
        $schema['datePublished'] = now()->toIso8601String();
        $schema['dateModified'] = $this->updated_at?->toIso8601String() ?? now()->toIso8601String();
        
        return $schema;
    }

    public function generateLocalBusinessSchema(): ?array
    {
        if (empty($this->organization_name) && empty($this->organization_address)) {
            return null;
        }
        
        $schema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            'name' => $this->organization_name ?? config('app.name', 'Business'),
            'url' => $this->getSiteUrl(),
        ];
        
        if ($this->organization_phone) {
            $schema['telephone'] = $this->organization_phone;
        }
        
        if ($this->organization_email) {
            $schema['email'] = $this->organization_email;
        }
        
        if ($this->organization_address) {
            $schema['address'] = [
                '@type' => 'PostalAddress',
                'addressLocality' => $this->organization_address,
            ];
        }
        
        if ($this->organization_logo) {
            $schema['image'] = asset('storage/' . $this->organization_logo);
        }
        
        return $schema;
    }

    public function getAllSchemas(?string $pageUrl = null, ?string $pageTitle = null, ?string $pageDescription = null): array
    {
        $schemas = [];
        
        $websiteSchema = $this->generateWebsiteSchema();
        if ($websiteSchema) {
            $schemas[] = $websiteSchema;
        }
        
        $organizationSchema = $this->generateOrganizationSchema();
        if ($organizationSchema) {
            $schemas[] = $organizationSchema;
        }
        
        $webpageSchema = $this->generateWebPageSchema($pageUrl, $pageTitle, $pageDescription);
        if ($webpageSchema) {
            $schemas[] = $webpageSchema;
        }
        
        $localBusinessSchema = $this->generateLocalBusinessSchema();
        if ($localBusinessSchema) {
            $schemas[] = $localBusinessSchema;
        }
        
        return $schemas;
    }

    public function getAllSocialLinks(): array
    {
        $links = [];
        
        if ($this->facebook_url) {
            $links['facebook'] = $this->facebook_url;
        }
        
        if ($this->twitter_url) {
            $links['twitter'] = $this->twitter_url;
        }
        
        if ($this->linkedin_url) {
            $links['linkedin'] = $this->linkedin_url;
        }
        
        if ($this->instagram_url) {
            $links['instagram'] = $this->instagram_url;
        }
        
        if ($this->youtube_url) {
            $links['youtube'] = $this->youtube_url;
        }
        
        return $links;
    }

    public function seoHealthCheck(): array
    {
        $checks = [];
        
        // Meta Title
        $metaTitleLength = strlen($this->meta_title ?? '');
        $checks['meta_title'] = [
            'label' => 'Meta Title',
            'status' => $metaTitleLength >= 30 && $metaTitleLength <= 60 ? 'success' : ($metaTitleLength > 0 ? 'warning' : 'error'),
            'message' => $metaTitleLength > 0 
                ? "{$metaTitleLength} characters (ideal: 30-60)"
                : 'Missing meta title',
        ];
        
        // Meta Description
        $metaDescLength = strlen($this->meta_description ?? '');
        $checks['meta_description'] = [
            'label' => 'Meta Description',
            'status' => $metaDescLength >= 120 && $metaDescLength <= 160 ? 'success' : ($metaDescLength > 0 ? 'warning' : 'error'),
            'message' => $metaDescLength > 0 
                ? "{$metaDescLength} characters (ideal: 120-160)"
                : 'Missing meta description',
        ];
        
        // Meta Keywords
        $checks['meta_keywords'] = [
            'label' => 'Meta Keywords',
            'status' => !empty($this->meta_keywords) ? 'success' : 'warning',
            'message' => !empty($this->meta_keywords) ? 'Keywords configured' : 'No keywords set',
        ];
        
        // OG Image
        $checks['og_image'] = [
            'label' => 'OG Image',
            'status' => !empty($this->og_image) ? 'success' : 'error',
            'message' => !empty($this->og_image) ? 'OG image configured' : 'Missing OG image',
        ];
        
        // Twitter Image
        $checks['twitter_image'] = [
            'label' => 'Twitter Image',
            'status' => !empty($this->twitter_image) ? 'success' : 'warning',
            'message' => !empty($this->twitter_image) ? 'Twitter image configured' : 'Using OG image fallback',
        ];
        
        // Canonical URL
        $checks['canonical_url'] = [
            'label' => 'Canonical URL',
            'status' => !empty($this->canonical_url) ? 'success' : 'warning',
            'message' => !empty($this->canonical_url) ? 'Canonical URL set' : 'Using default URL',
        ];
        
        // Schema Markup
        $hasOrgSchema = !empty($this->organization_name);
        $checks['schema_markup'] = [
            'label' => 'Schema Markup',
            'status' => $hasOrgSchema ? 'success' : 'warning',
            'message' => $hasOrgSchema ? 'Organization schema configured' : 'Add organization details for schema',
        ];
        
        // Robots.txt
        $hasRobotsContent = !empty($this->robots_txt_content);
        $checks['robots_txt'] = [
            'label' => 'Robots.txt',
            'status' => $hasRobotsContent ? 'success' : 'success',
            'message' => $hasRobotsContent ? 'Custom robots.txt configured' : 'Using default robots.txt',
        ];
        
        // Sitemap
        $checks['sitemap'] = [
            'label' => 'XML Sitemap',
            'status' => $this->sitemap_enabled ? 'success' : 'warning',
            'message' => $this->sitemap_enabled ? 'Sitemap enabled' : 'Sitemap disabled',
        ];
        
        // Google Analytics
        $checks['google_analytics'] = [
            'label' => 'Google Analytics',
            'status' => !empty($this->google_analytics_id) ? 'success' : 'warning',
            'message' => !empty($this->google_analytics_id) ? 'GA configured' : 'Not configured',
        ];
        
        // Search Engine Indexing
        $checks['indexing'] = [
            'label' => 'Search Indexing',
            'status' => $this->shouldIndex() ? 'success' : 'warning',
            'message' => $this->shouldIndex() ? 'Indexing enabled' : 'Indexing disabled',
        ];
        
        return $checks;
    }
}

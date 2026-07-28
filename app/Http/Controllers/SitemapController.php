<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Project;
use App\Models\SeoSetting;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        $seo = SeoSetting::instance();
        
        // Return 404 if sitemap is disabled
        if (!$seo->sitemap_enabled) {
            abort(404);
        }
        
        $cacheKey = 'sitemap_xml';
        $cacheDuration = 3600; // 1 hour
        
        $content = Cache::remember($cacheKey, $cacheDuration, function () use ($seo) {
            return $this->generateSitemap($seo);
        });
        
        return response($content, 200, [
            'Content-Type' => 'application/xml',
            'charset' => 'utf-8',
        ]);
    }
    
    private function generateSitemap(SeoSetting $seo): string
    {
        $siteUrl = config('app.url', request()->getSchemeAndHttpHost());
        
        $xml = new \XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('  ');
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
        $xml->writeAttribute('xmlns:xhtml', 'http://www.w3.org/1999/xhtml');
        $xml->writeAttribute('xmlns:image', 'http://www.google.com/schemas/sitemap-image/1.1');
        
        // Home page
        $this->addUrl($xml, $siteUrl, '1.0', 'daily', now());
        
        // About page
        $this->addUrl($xml, $siteUrl . '/about', '0.8', 'monthly', now());
        
        // Services
        $this->addUrl($xml, $siteUrl . '/services', '0.9', 'weekly', now());
        
        // Service detail pages
        Service::where('is_active', true)
            ->whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->chunk(100, function ($services) use ($xml, $siteUrl) {
                foreach ($services as $service) {
                    $this->addUrl($xml, $siteUrl . '/services/' . $service->slug, '0.7', 'weekly', $service->updated_at);
                }
            });
        
        // Projects
        $this->addUrl($xml, $siteUrl . '/projects', '0.9', 'weekly', now());
        
        // Project detail pages
        Project::where('status', 'published')
            ->whereNotNull('slug')
            ->select('slug', 'updated_at')
            ->chunk(100, function ($projects) use ($xml, $siteUrl) {
                foreach ($projects as $project) {
                    $this->addUrl($xml, $siteUrl . '/projects/' . $project->slug, '0.7', 'monthly', $project->updated_at);
                }
            });
        
        // Blog
        $this->addUrl($xml, $siteUrl . '/blog', '0.9', 'daily', now());
        
        // Blog posts
        Blog::where('is_published', true)
            ->whereNotNull('slug')
            ->select('slug', 'updated_at', 'published_at')
            ->chunk(100, function ($blogs) use ($xml, $siteUrl) {
                foreach ($blogs as $blog) {
                    $this->addUrl($xml, $siteUrl . '/blog/' . $blog->slug, '0.6', 'weekly', $blog->published_at ?? $blog->updated_at);
                }
            });
        
        // Contact
        $this->addUrl($xml, $siteUrl . '/contact', '0.5', 'monthly', now());
        
        $xml->endElement(); // urlset
        $xml->endDocument();
        
        return $xml->outputMemory();
    }
    
    private function addUrl(\XMLWriter $xml, string $url, string $priority, string $frequency, $lastmod = null): void
    {
        $xml->startElement('url');
        $xml->writeElement('loc', $url);
        
        if ($lastmod) {
            $xml->writeElement('lastmod', $lastmod->toIso8601String());
        }
        
        $xml->writeElement('changefreq', $frequency);
        $xml->writeElement('priority', $priority);
        
        $xml->endElement(); // url
    }
    
    /**
     * Clear sitemap cache (called after content updates)
     */
    public static function clearCache(): void
    {
        Cache::forget('sitemap_xml');
    }
}

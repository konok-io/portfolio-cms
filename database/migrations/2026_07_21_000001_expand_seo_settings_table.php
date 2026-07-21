<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            // General SEO
            $table->string('meta_author')->nullable()->after('meta_keywords');
            $table->string('meta_language')->default('en')->after('meta_author');
            $table->string('canonical_url')->nullable()->after('meta_language');
            
            // Homepage SEO
            $table->string('home_meta_title')->nullable()->after('canonical_url');
            $table->text('home_meta_description')->nullable()->after('home_meta_title');
            $table->string('home_meta_keywords')->nullable()->after('home_meta_description');
            
            // Open Graph (Facebook)
            $table->string('og_title')->nullable()->after('home_meta_keywords');
            $table->string('og_description')->nullable()->after('og_title');
            $table->string('og_image')->nullable()->change();
            $table->string('og_type')->default('website')->after('og_image');
            $table->string('og_site_name')->nullable()->after('og_type');
            $table->string('og_locale')->default('en_US')->after('og_site_name');
            
            // Twitter SEO
            $table->string('twitter_title')->nullable()->after('og_locale');
            $table->string('twitter_description')->nullable()->after('twitter_title');
            $table->string('twitter_image')->nullable()->after('twitter_description');
            $table->string('twitter_card_type')->default('summary_large_image')->after('twitter_image');
            $table->string('twitter_site')->nullable()->after('twitter_card_type');
            $table->string('twitter_creator')->nullable()->after('twitter_site');
            
            // Search Engine Settings
            $table->boolean('allow_indexing')->default(true)->after('twitter_creator');
            $table->boolean('allow_following')->default(true)->after('allow_indexing');
            $table->boolean('allow_archiving')->default(true)->after('allow_following');
            $table->boolean('allow_snippet')->default(true)->after('allow_archiving');
            
            // Verification Codes
            $table->string('google_site_verification')->nullable()->after('allow_snippet');
            $table->string('bing_site_verification')->nullable()->after('google_site_verification');
            $table->string('yandex_verification')->nullable()->after('bing_site_verification');
            $table->string('pinterest_verification')->nullable()->after('yandex_verification');
            
            // Analytics
            $table->string('google_analytics_id')->nullable()->after('pinterest_verification');
            $table->string('google_tag_manager_id')->nullable()->after('google_analytics_id');
            $table->string('facebook_pixel_id')->nullable()->after('google_tag_manager_id');
            $table->string('microsoft_clarity_id')->nullable()->after('facebook_pixel_id');
            
            // Schema Settings
            $table->string('organization_name')->nullable()->after('microsoft_clarity_id');
            $table->string('organization_logo')->nullable()->after('organization_name');
            $table->string('organization_phone')->nullable()->after('organization_logo');
            $table->string('organization_email')->nullable()->after('organization_phone');
            $table->text('organization_address')->nullable()->after('organization_email');
            
            // Social Links
            $table->string('facebook_url')->nullable()->after('organization_address');
            $table->string('twitter_url')->nullable()->after('facebook_url');
            $table->string('linkedin_url')->nullable()->after('twitter_url');
            $table->string('instagram_url')->nullable()->after('linkedin_url');
            $table->string('youtube_url')->nullable()->after('instagram_url');
            
            // Technical SEO
            $table->longText('robots_txt_content')->nullable()->after('youtube_url');
            $table->longText('custom_head_code')->nullable()->after('robots_txt_content');
            $table->longText('custom_body_code')->nullable()->after('custom_head_code');
            
            // XML Sitemap
            $table->boolean('sitemap_enabled')->default(true)->after('custom_body_code');
            $table->string('sitemap_url')->nullable()->after('sitemap_enabled');
        });
    }

    public function down(): void
    {
        Schema::table('seo_settings', function (Blueprint $table) {
            $columns = [
                'meta_author', 'meta_language', 'canonical_url',
                'home_meta_title', 'home_meta_description', 'home_meta_keywords',
                'og_title', 'og_description', 'og_type', 'og_site_name', 'og_locale',
                'twitter_title', 'twitter_description', 'twitter_image', 'twitter_card_type', 'twitter_site', 'twitter_creator',
                'allow_indexing', 'allow_following', 'allow_archiving', 'allow_snippet',
                'google_site_verification', 'bing_site_verification', 'yandex_verification', 'pinterest_verification',
                'google_analytics_id', 'google_tag_manager_id', 'facebook_pixel_id', 'microsoft_clarity_id',
                'organization_name', 'organization_logo', 'organization_phone', 'organization_email', 'organization_address',
                'facebook_url', 'twitter_url', 'linkedin_url', 'instagram_url', 'youtube_url',
                'robots_txt_content', 'custom_head_code', 'custom_body_code',
                'sitemap_enabled', 'sitemap_url'
            ];
            
            foreach ($columns as $column) {
                if (Schema::hasColumn('seo_settings', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

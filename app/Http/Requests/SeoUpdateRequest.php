<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // General SEO
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_author' => ['nullable', 'string', 'max:100'],
            'meta_language' => ['nullable', 'string', 'max:10'],
            'canonical_url' => ['nullable', 'url', 'max:255'],
            
            // Homepage SEO
            'home_meta_title' => ['nullable', 'string', 'max:255'],
            'home_meta_description' => ['nullable', 'string', 'max:500'],
            'home_meta_keywords' => ['nullable', 'string', 'max:500'],
            
            // Open Graph (Facebook)
            'og_title' => ['nullable', 'string', 'max:255'],
            'og_description' => ['nullable', 'string', 'max:500'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'og_type' => ['nullable', 'string', Rule::in([
                'website', 'article', 'book', 'books.author', 'books.genre',
                'business.business', 'business.organization', 'business.store',
                'event', 'film', 'food.establishment', 'game.achievement',
                'music.album', 'music.music_recording', 'music.playlist',
                'person', 'place', 'product', 'product.group', 'product.item',
                'profile', 'restaurant', 'restaurant.menu', 'video.movie',
                'video.episode', 'video.tv_show', 'video.other', 'article'
            ])],
            'og_site_name' => ['nullable', 'string', 'max:100'],
            'og_locale' => ['nullable', 'string', 'max:10'],
            
            // Twitter SEO
            'twitter_title' => ['nullable', 'string', 'max:255'],
            'twitter_description' => ['nullable', 'string', 'max:500'],
            'twitter_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'twitter_card_type' => ['nullable', 'string', Rule::in([
                'summary', 'summary_large_image', 'app', 'player'
            ])],
            'twitter_site' => ['nullable', 'string', 'max:100'],
            'twitter_creator' => ['nullable', 'string', 'max:100'],
            
            // Search Engine Settings
            'allow_indexing' => ['nullable', 'boolean'],
            'allow_following' => ['nullable', 'boolean'],
            'allow_archiving' => ['nullable', 'boolean'],
            'allow_snippet' => ['nullable', 'boolean'],
            
            // Verification Codes
            'google_site_verification' => ['nullable', 'string', 'max:100'],
            'bing_site_verification' => ['nullable', 'string', 'max:100'],
            'yandex_verification' => ['nullable', 'string', 'max:100'],
            'pinterest_verification' => ['nullable', 'string', 'max:100'],
            
            // Analytics
            'google_analytics_id' => ['nullable', 'string', 'max:50'],
            'google_tag_manager_id' => ['nullable', 'string', 'max:50'],
            'facebook_pixel_id' => ['nullable', 'string', 'max:50'],
            'microsoft_clarity_id' => ['nullable', 'string', 'max:50'],
            
            // Schema Settings
            'organization_name' => ['nullable', 'string', 'max:255'],
            'organization_logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'organization_phone' => ['nullable', 'string', 'max:50'],
            'organization_email' => ['nullable', 'email', 'max:255'],
            'organization_address' => ['nullable', 'string', 'max:500'],
            
            // Social Links
            'facebook_url' => ['nullable', 'url', 'max:255'],
            'twitter_url' => ['nullable', 'url', 'max:255'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            
            // Technical SEO
            'robots_txt_content' => ['nullable', 'string'],
            'custom_head_code' => ['nullable', 'string'],
            'custom_body_code' => ['nullable', 'string'],
            
            // XML Sitemap
            'sitemap_enabled' => ['nullable', 'boolean'],
            'sitemap_url' => ['nullable', 'url', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'og_image.max' => 'OG Image must be less than 2MB.',
            'twitter_image.max' => 'Twitter Image must be less than 2MB.',
            'organization_logo.max' => 'Organization Logo must be less than 2MB.',
            'organization_email.email' => 'Please enter a valid email address.',
            '*.url' => 'Please enter a valid URL including http:// or https://',
        ];
    }

    protected function prepareForValidation(): void
    {
        $booleanFields = [
            'allow_indexing',
            'allow_following', 
            'allow_archiving',
            'allow_snippet',
            'sitemap_enabled',
        ];
        
        foreach ($booleanFields as $field) {
            if ($this->has($field)) {
                $value = $this->input($field);
                $this->merge([
                    $field => filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) ?? ($value === '1' || $value === 'true'),
                ]);
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\PageContent;
use App\Models\Setting;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display the content settings page
     */
    public function index()
    {
        $setting = Setting::instance();
        $content = PageContent::all();
        $pages = $this->getPages();
        
        // Get active tab from query parameter or default to first page
        $activeTab = request('tab', array_key_first($pages));
        
        return view('admin.content.index', compact('setting', 'content', 'pages', 'activeTab'));
    }

    /**
     * Update content settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'page' => 'required|string',
        ]);

        $page = $request->input('page');
        $data = $request->except(['_token', 'page']);

        // Group fields - multilingual structure
        $groupedData = [];
        foreach ($data as $key => $value) {
            if ($key !== 'page' && $key !== '_token') {
                // Check if field has language suffix
                if (preg_match('/^(.+)_(' . implode('|', $this->getSupportedLocales()) . ')$/', $key, $matches)) {
                    $fieldName = $matches[1];
                    $locale = $matches[2];
                    $groupedData[$fieldName][$locale] = $value;
                } else {
                    // No suffix - use as default for all locales
                    foreach ($this->getSupportedLocales() as $locale) {
                        $groupedData[$key][$locale] = $value;
                    }
                }
            }
        }

        // Save to settings
        $setting = Setting::instance();
        $pageContent = $setting->page_content ?? [];
        $pageContent[$page] = array_merge($pageContent[$page] ?? [], $groupedData);
        $setting->page_content = $pageContent;
        $setting->save();

        // Clear cache
        PageContent::clearCache();

        return redirect()->route('admin.content.index', ['tab' => $page])->with('success', 'Content updated successfully!');
    }

    /**
     * Update page sections order (for default pages)
     */
    public function updateSectionsOrder(Request $request)
    {
        $request->validate([
            'page' => 'required|string',
            'sections_order' => 'required|string',
        ]);

        $page = $request->input('page');
        $sectionsOrder = explode(',', $request->input('sections_order'));

        // Save sections order
        $setting = Setting::instance();
        $pageContent = $setting->page_content ?? [];
        $pageContent[$page]['_sections_order'] = $sectionsOrder;
        $setting->page_content = $pageContent;
        $setting->save();

        // Clear cache
        PageContent::clearCache();

        return redirect()->route('admin.content.index', ['tab' => $page])->with('success', 'Sections order updated successfully!');
    }

    /**
     * Reset page content to default
     */
    public function reset(Request $request)
    {
        $page = $request->query('page', 'home');
        
        // Remove page from settings
        $setting = Setting::instance();
        $pageContent = $setting->page_content ?? [];
        
        if (isset($pageContent[$page])) {
            unset($pageContent[$page]);
            $setting->page_content = $pageContent;
            $setting->save();
        }

        // Clear cache
        PageContent::clearCache();

        return redirect()->route('admin.content.index', ['tab' => $page])->with('success', 'Content reset to default!');
    }

    /**
     * Get supported locales
     */
    private function getSupportedLocales(): array
    {
        return ['en', 'bn', 'ar'];
    }

    /**
     * Get pages configuration
     */
    private function getPages(): array
    {
        $pages = [];

        // 1. HEADER - Site-wide header content (AT THE TOP)
        $pages['header'] = [
            'name' => 'Header',
            'sections' => [
                'general' => [
                    'name' => 'Header Content',
                    'fields' => ['logo_text', 'tagline']
                ],
            ]
        ];

        // 2. PAGE-SPECIFIC CONTENT
        $pages['home'] = [
            'name' => 'Home Page',
            'page_key' => 'home',
            'fields' => ['eyebrow', 'button_hire', 'button_cv', 'badge'],
            'section_shortcodes' => [
                'hero' => 'Hero Section',
                'why' => 'Why Choose Me',
                'skills' => 'Skills',
                'services' => 'Services',
                'experience' => 'Experience',
                'education' => 'Education',
                'portfolio' => 'Portfolio',
                'testimonials' => 'Testimonials',
                'certifications' => 'Certifications',
                'blog' => 'Blog',
                'contact' => 'Contact',
            ]
        ];

        $pages['about'] = [
            'name' => 'About Page',
            'page_key' => 'about',
            'fields' => ['eyebrow', 'title', 'intro_button'],
            'section_shortcodes' => []
        ];

        $pages['services'] = [
            'name' => 'Services Page',
            'page_key' => 'services',
            'fields' => ['eyebrow', 'title', 'subtitle', 'empty_text', 'cta_heading', 'cta_button'],
            'section_shortcodes' => []
        ];

        $pages['portfolio'] = [
            'name' => 'Portfolio Page',
            'page_key' => 'portfolio',
            'fields' => ['eyebrow', 'title', 'subtitle', 'filter_all', 'filter_label', 'empty_text', 'empty_button', 'card_link', 'card_client'],
            'section_shortcodes' => []
        ];

        $pages['blog'] = [
            'name' => 'Blog Page',
            'page_key' => 'blog',
            'fields' => ['eyebrow', 'title', 'subtitle', 'filter_label', 'filter_clear', 'empty_text', 'empty_button', 'card_link'],
            'section_shortcodes' => [
                'page' => 'Page Header',
                'sidebar' => 'Sidebar',
            ]
        ];

        $pages['contact'] = [
            'name' => 'Contact Page',
            'page_key' => 'contact',
            'fields' => ['eyebrow', 'title', 'subtitle', 'form_name', 'form_email', 'form_phone', 'form_subject', 'form_message', 'form_button', 'info_title', 'info_email', 'info_phone', 'info_address', 'map_placeholder'],
            'section_shortcodes' => [
                'page' => 'Page Header',
                'form' => 'Contact Form',
                'info' => 'Contact Info',
            ]
        ];

        $pages['faq'] = [
            'name' => 'FAQ Page',
            'page_key' => 'faq',
            'fields' => ['eyebrow', 'title', 'subtitle'],
            'section_shortcodes' => []
        ];

        $pages['resume'] = [
            'name' => 'Resume Page',
            'page_key' => 'resume',
            'fields' => ['eyebrow', 'title', 'subtitle'],
            'section_shortcodes' => []
        ];

        $pages['pricing'] = [
            'name' => 'Pricing Page',
            'page_key' => 'pricing',
            'fields' => ['eyebrow', 'title', 'subtitle'],
            'section_shortcodes' => []
        ];

        // 3. FOOTER - AT THE BOTTOM
        $pages['footer'] = [
            'name' => 'Footer',
            'sections' => [
                'general' => [
                    'name' => 'Footer Content',
                    'fields' => ['tagline', 'quick_links_title', 'contact_title', 'newsletter_title', 'newsletter_text', 'newsletter_placeholder', 'copyright', 'copyright_prefix']
                ],
            ]
        ];

        // 4. CUSTOM PAGES - AFTER FOOTER
        $customPages = CustomPage::orderBy('sort_order')->get();
        foreach ($customPages as $customPage) {
            $pageKey = 'custom_' . $customPage->id;
            $pages[$pageKey] = [
                'name' => $customPage->title . ($customPage->is_published ? '' : ' (Draft)'),
                'is_custom' => true,
                'custom_id' => $customPage->id,
                'sections' => [
                    'page' => ['name' => 'Page Header', 'fields' => ['eyebrow', 'title', 'subtitle']],
                ]
            ];
        }

        return $pages;
    }
}

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
        
        // Get all pages config including custom pages
        $allPages = $this->getPages();
        $currentPageConfig = $allPages[$page] ?? null;

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
     * Get pages configuration including custom pages
     */
    private function getPages(): array
    {
        $pages = [
            'home' => [
                'name' => 'Home Page',
                'sections' => [
                    'hero' => [
                        'name' => 'Hero Section',
                        'fields' => ['eyebrow', 'button_hire', 'button_cv', 'badge']
                    ],
                    'why' => [
                        'name' => 'Why Choose Me',
                        'fields' => ['title', 'card1_title', 'card1_text', 'card2_title', 'card2_text', 'card3_title', 'card3_text', 'button']
                    ],
                    'skills' => [
                        'name' => 'Skills Section',
                        'fields' => ['title', 'subtitle']
                    ],
                    'services' => [
                        'name' => 'Services Section',
                        'fields' => ['title', 'subtitle', 'button']
                    ],
                    'experience' => [
                        'name' => 'Experience Section',
                        'fields' => ['title', 'subtitle']
                    ],
                    'education' => [
                        'name' => 'Education Section',
                        'fields' => ['title', 'subtitle']
                    ],
                    'portfolio' => [
                        'name' => 'Portfolio Section',
                        'fields' => ['title', 'subtitle', 'button', 'card_link']
                    ],
                    'testimonials' => [
                        'name' => 'Testimonials Section',
                        'fields' => ['title', 'video_button']
                    ],
                    'certifications' => [
                        'name' => 'Certifications Section',
                        'fields' => ['title', 'description', 'verify']
                    ],
                    'blog' => [
                        'name' => 'Blog Section',
                        'fields' => ['title', 'button', 'card_link']
                    ],
                    'contact' => [
                        'name' => 'Contact Section',
                        'fields' => ['eyebrow', 'title', 'text', 'label_email', 'label_phone', 'label_location', 'form_name', 'form_email', 'form_phone', 'form_subject', 'form_message', 'form_button']
                    ],
                ]
            ],
            'about' => [
                'name' => 'About Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'intro_button']
                    ],
                ]
            ],
            'services' => [
                'name' => 'Services Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle', 'empty_text', 'cta_heading', 'cta_button']
                    ],
                ]
            ],
            'portfolio' => [
                'name' => 'Portfolio Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle', 'filter_all', 'filter_label', 'empty_text', 'empty_button', 'card_link', 'card_client']
                    ],
                ]
            ],
            'blog' => [
                'name' => 'Blog Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle', 'filter_label', 'filter_clear', 'empty_text', 'empty_button', 'card_link']
                    ],
                    'sidebar' => [
                        'name' => 'Sidebar',
                        'fields' => ['search', 'search_placeholder', 'categories', 'all_categories', 'view_categories', 'tags']
                    ],
                ]
            ],
            'contact' => [
                'name' => 'Contact Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle']
                    ],
                    'form' => [
                        'name' => 'Contact Form',
                        'fields' => ['form_name', 'form_email', 'form_phone', 'form_subject', 'form_message', 'form_button']
                    ],
                    'info' => [
                        'name' => 'Contact Info',
                        'fields' => ['info_title', 'info_email', 'info_phone', 'info_address', 'map_placeholder']
                    ],
                ]
            ],
            'footer' => [
                'name' => 'Footer',
                'sections' => [
                    'general' => [
                        'name' => 'Footer Content',
                        'fields' => ['tagline', 'quick_links_title', 'contact_title', 'newsletter_title', 'newsletter_text', 'newsletter_placeholder', 'copyright', 'copyright_prefix']
                    ],
                ]
            ],
            'faq' => [
                'name' => 'FAQ Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle']
                    ],
                ]
            ],
            'resume' => [
                'name' => 'Resume Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle']
                    ],
                ]
            ],
            'pricing' => [
                'name' => 'Pricing Page',
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle']
                    ],
                ]
            ],
        ];

        // Add custom pages dynamically from database (all pages, not just published)
        $customPages = CustomPage::orderBy('sort_order')->get();
        foreach ($customPages as $customPage) {
            $pageKey = 'custom_' . $customPage->id;
            $pages[$pageKey] = [
                'name' => $customPage->title . ($customPage->is_published ? '' : ' (Draft)'),
                'is_custom' => true,
                'custom_id' => $customPage->id,
                'sections' => [
                    'page' => [
                        'name' => 'Page Header',
                        'fields' => ['eyebrow', 'title', 'subtitle']
                    ],
                ]
            ];
        }

        return $pages;
    }
}

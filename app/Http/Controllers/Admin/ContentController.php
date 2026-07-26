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
            if ($key !== 'page' && $key !== '_token' && $key !== 'sections_order') {
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
        
        // Get existing sections order if not in current request
        $existingContent = $pageContent[$page] ?? [];
        $sectionsOrder = $request->input('sections_order') ?? ($existingContent['_sections_order'] ?? null);
        
        $pageContent[$page] = array_merge($existingContent, $groupedData);
        
        // Save sections order if changed
        if ($sectionsOrder) {
            $pageContent[$page]['_sections_order'] = explode(',', $sectionsOrder);
        }
        
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
            'sections' => [
                'hero' => [
                    'name' => 'Hero Section',
                    'fields' => ['hero_eyebrow', 'hero_button_hire', 'hero_button_cv', 'hero_badge']
                ],
                'why' => [
                    'name' => 'Why Choose Me',
                    'fields' => ['why_eyebrow', 'why_title', 'why_card1_title', 'why_card1_text', 'why_card2_title', 'why_card2_text', 'why_card3_title', 'why_card3_text']
                ],
                'skills' => [
                    'name' => 'Skills Section',
                    'fields' => []
                ],
                'services' => [
                    'name' => 'Services Section',
                    'fields' => ['services_eyebrow', 'services_title', 'services_subtitle']
                ],
                'experience' => [
                    'name' => 'Experience Section',
                    'fields' => []
                ],
                'education' => [
                    'name' => 'Education Section',
                    'fields' => []
                ],
                'portfolio' => [
                    'name' => 'Portfolio Section',
                    'fields' => []
                ],
                'testimonials' => [
                    'name' => 'Testimonials Section',
                    'fields' => []
                ],
                'certifications' => [
                    'name' => 'Certifications Section',
                    'fields' => []
                ],
                'blog' => [
                    'name' => 'Blog Section',
                    'fields' => ['blog_eyebrow', 'blog_title', 'blog_button', 'blog_card_link']
                ],
                'contact' => [
                    'name' => 'Contact Section',
                    'fields' => ['contact_eyebrow', 'contact_title', 'contact_text', 'contact_label_email', 'contact_label_phone', 'contact_label_location', 'contact_form_name', 'contact_form_email', 'contact_form_phone', 'contact_form_subject', 'contact_form_message', 'contact_form_button']
                ],
            ]
        ];

        $pages['about'] = [
            'name' => 'About Page',
            'page_key' => 'about',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => ['page_eyebrow', 'page_title'],
                ],
            ]
        ];

        $pages['services'] = [
            'name' => 'Services Page',
            'page_key' => 'services',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => ['page_title', 'page_eyebrow', 'page_subtitle'],
                ],
                'empty' => [
                    'name' => 'Empty State',
                    'fields' => ['empty_text'],
                ],
                'cta' => [
                    'name' => 'Call to Action',
                    'fields' => ['cta_heading', 'cta_button', 'view_all'],
                ],
            ]
        ];

        $pages['portfolio'] = [
            'name' => 'Portfolio Page',
            'page_key' => 'portfolio',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => [],
                ],
            ]
        ];

        $pages['blog'] = [
            'name' => 'Blog Page',
            'page_key' => 'blog',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => [],
                ],
            ]
        ];

        $pages['contact'] = [
            'name' => 'Contact Page',
            'page_key' => 'contact',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => ['page_eyebrow', 'page_title', 'page_subtitle'],
                ],
                'form' => [
                    'name' => 'Contact Form',
                    'fields' => ['form_phone', 'form_subject', 'form_message', 'form_button'],
                ],
            ]
        ];

        $pages['faq'] = [
            'name' => 'FAQ Page',
            'page_key' => 'faq',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => [],
                ],
            ]
        ];

        $pages['resume'] = [
            'name' => 'Resume Page',
            'page_key' => 'resume',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => [],
                ],
            ]
        ];

        $pages['pricing'] = [
            'name' => 'Pricing Page',
            'page_key' => 'pricing',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => [],
                ],
            ]
        ];

        $pages['search'] = [
            'name' => 'Search Page',
            'page_key' => 'search',
            'sections' => [
                'page' => [
                    'name' => 'Page Content',
                    'fields' => ['page_title', 'form_placeholder', 'projects_title', 'empty_title', 'empty_text', 'empty_projects', 'empty_blogs', 'empty_services'],
                ],
            ]
        ];

        // 3. CUSTOM PAGES - BEFORE FOOTER
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

        // 4. FOOTER - ALWAYS AT THE BOTTOM
        $pages['footer'] = [
            'name' => 'Footer',
            'sections' => [
                'general' => [
                    'name' => 'Footer Content',
                    'fields' => ['tagline', 'quick_links_title', 'contact_title', 'newsletter_title', 'newsletter_text', 'newsletter_placeholder', 'copyright', 'copyright_prefix']
                ],
            ]
        ];

        return $pages;
    }
}

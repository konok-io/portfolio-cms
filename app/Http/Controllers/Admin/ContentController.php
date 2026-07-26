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
            'section_shortcodes' => [
                'hero' => [
                    'name' => 'Hero Section',
                    'fields' => ['eyebrow', 'button_hire', 'button_cv', 'badge']
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
                    'fields' => ['services_eyebrow', 'services_title', 'services_subtitle', 'services_button']
                ],
                'experience' => [
                    'name' => 'Experience Section',
                    'fields' => ['experience_eyebrow', 'experience_title']
                ],
                'education' => [
                    'name' => 'Education Section',
                    'fields' => ['education_eyebrow', 'education_title']
                ],
                'portfolio' => [
                    'name' => 'Portfolio Section',
                    'fields' => ['portfolio_eyebrow', 'portfolio_title', 'portfolio_subtitle']
                ],
                'testimonials' => [
                    'name' => 'Testimonials Section',
                    'fields' => ['testimonials_eyebrow', 'testimonials_title']
                ],
                'certifications' => [
                    'name' => 'Certifications Section',
                    'fields' => ['certifications_eyebrow', 'certifications_title']
                ],
                'blog' => [
                    'name' => 'Blog Section',
                    'fields' => ['blog_eyebrow', 'blog_title', 'blog_subtitle', 'blog_card_link']
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
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle', 'intro_button'],
                ],
                'skills' => [
                    'name' => 'Skills Section',
                    'fields' => ['skills_eyebrow', 'skills_title', 'skills_subtitle'],
                ],
                'experience' => [
                    'name' => 'Experience Section',
                    'fields' => ['experience_eyebrow', 'experience_title', 'experience_subtitle'],
                ],
                'education' => [
                    'name' => 'Education Section',
                    'fields' => ['education_eyebrow', 'education_title', 'education_subtitle'],
                ],
                'certifications' => [
                    'name' => 'Certifications Section',
                    'fields' => ['certifications_eyebrow', 'certifications_title', 'certifications_subtitle'],
                ],
                'cta' => [
                    'name' => 'Call to Action',
                    'fields' => ['cta_title', 'cta_text', 'cta_button'],
                ],
            ]
        ];

        $pages['services'] = [
            'name' => 'Services Page',
            'page_key' => 'services',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
                ],
                'cta' => [
                    'name' => 'Call to Action',
                    'fields' => ['cta_heading', 'cta_text', 'cta_button'],
                ],
            ]
        ];

        $pages['portfolio'] = [
            'name' => 'Portfolio Page',
            'page_key' => 'portfolio',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
                ],
                'filters' => [
                    'name' => 'Filter Labels',
                    'fields' => ['filter_all', 'filter_label'],
                ],
                'empty_state' => [
                    'name' => 'Empty State',
                    'fields' => ['empty_text', 'empty_button'],
                ],
                'card_labels' => [
                    'name' => 'Card Labels',
                    'fields' => ['card_link', 'card_client'],
                ],
            ]
        ];

        $pages['blog'] = [
            'name' => 'Blog Page',
            'page_key' => 'blog',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
                ],
                'sidebar' => [
                    'name' => 'Sidebar',
                    'fields' => ['filter_label', 'filter_clear'],
                ],
                'empty_state' => [
                    'name' => 'Empty State',
                    'fields' => ['empty_text', 'empty_button', 'card_link'],
                ],
            ]
        ];

        $pages['contact'] = [
            'name' => 'Contact Page',
            'page_key' => 'contact',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
                ],
                'form' => [
                    'name' => 'Contact Form Labels',
                    'fields' => ['form_name', 'form_email', 'form_phone', 'form_subject', 'form_message', 'form_button'],
                ],
                'info' => [
                    'name' => 'Contact Info Labels',
                    'fields' => ['info_title', 'info_email', 'info_phone', 'info_address'],
                ],
                'map' => [
                    'name' => 'Map',
                    'fields' => ['map_placeholder'],
                ],
            ]
        ];

        $pages['faq'] = [
            'name' => 'FAQ Page',
            'page_key' => 'faq',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
                ],
            ]
        ];

        $pages['resume'] = [
            'name' => 'Resume Page',
            'page_key' => 'resume',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
                ],
            ]
        ];

        $pages['pricing'] = [
            'name' => 'Pricing Page',
            'page_key' => 'pricing',
            'sections' => [
                'header' => [
                    'name' => 'Page Header',
                    'fields' => ['eyebrow', 'title', 'subtitle'],
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

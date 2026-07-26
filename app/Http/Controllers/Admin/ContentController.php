<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\MenuItem;
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
        $pages = $this->getDynamicPages();
        $footerLinks = $this->getFooterLinks();
        $dynamicItems = $this->getDynamicItems();
        
        // Get active tab from query parameter or default to first page
        $activeTab = request('tab', array_key_first($pages));
        
        return view('admin.content.index', compact('setting', 'content', 'pages', 'activeTab', 'footerLinks', 'dynamicItems'));
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
     * Get footer links from menu items or custom pages
     */
    private function getFooterLinks(): array
    {
        $links = [];
        
        try {
            // Get from menu items first
            if (class_exists('App\Models\MenuItem')) {
                $menuItems = MenuItem::active()
                    ->where('menu_type', 'footer')
                    ->orderBy('order')
                    ->get();
                    
                if ($menuItems->isNotEmpty()) {
                    foreach ($menuItems as $item) {
                        $links[] = [
                            'title' => $item->name,
                            'url' => $item->link,
                            'type' => 'menu'
                        ];
                    }
                }
            }
            
            // Fallback to custom pages if no menu items (getFooterPages already returns Collection with ->get())
            if (empty($links)) {
                $customPages = CustomPage::getFooterPages();
                foreach ($customPages as $page) {
                    $links[] = [
                        'title' => $page->title,
                        'url' => '/' . $page->slug,
                        'type' => 'custom'
                    ];
                }
            }
        } catch (\Throwable $e) {
            // Return empty if database not ready
        }
        
        return $links;
    }
    
    /**
     * Get dynamic items from database for content settings
     */
    private function getDynamicItems(): array
    {
        $items = [];
        
        try {
            // Skills
            if (class_exists('App\Models\Skill')) {
                $items['skills'] = \App\Models\Skill::orderBy('sort_order')->get(['id', 'name', 'percentage'])->toArray();
            }
            
            // Experience
            if (class_exists('App\Models\Experience')) {
                $items['experience'] = \App\Models\Experience::orderBy('start_date', 'desc')->get(['id', 'job_title', 'company'])->toArray();
            }
            
            // Education
            if (class_exists('App\Models\Education')) {
                $items['education'] = \App\Models\Education::orderBy('start_date', 'desc')->get(['id', 'degree', 'institution'])->toArray();
            }
            
            // Portfolio/Projects
            if (class_exists('App\Models\Project')) {
                $items['portfolio'] = \App\Models\Project::where('is_published', true)->orderBy('sort_order')->get(['id', 'title', 'category'])->toArray();
            }
            
            // Testimonials
            if (class_exists('App\Models\Testimonial')) {
                $items['testimonials'] = \App\Models\Testimonial::where('is_published', true)->orderBy('sort_order')->get(['id', 'name', 'company'])->toArray();
            }
            
            // Certifications
            if (class_exists('App\Models\Certification')) {
                $items['certifications'] = \App\Models\Certification::orderBy('sort_order')->get(['id', 'name', 'issuer'])->toArray();
            }
        } catch (\Throwable $e) {
            // Return empty arrays if database not ready
        }
        
        return $items;
    }

    /**
     * Get dynamic pages configuration based on database content
     */
    private function getDynamicPages(): array
    {
        $pages = [];
        
        // Get dynamic footer links from menu items
        $footerLinks = $this->getFooterLinks();
        $footerLinkFields = [];
        foreach ($footerLinks as $index => $link) {
            $fieldKey = 'link_' . ($index + 1);
            $footerLinkFields[] = $fieldKey;
        }
        
        // Also include any custom page links for footer (getFooterPages already returns Collection)
        $customPages = CustomPage::getFooterPages();
        foreach ($customPages as $cpIndex => $page) {
            $fieldKey = 'custom_link_' . ($cpIndex + 1);
            $footerLinkFields[] = $fieldKey;
        }

        // 1. HOME PAGE - All sections with full content
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
                    'fields' => ['skills_eyebrow', 'skills_title'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'skills',
                    'dynamic_info' => 'Skills are pulled from Skills Manager'
                ],
                'services' => [
                    'name' => 'Services Section',
                    'fields' => ['services_eyebrow', 'services_title', 'services_subtitle']
                ],
                'experience' => [
                    'name' => 'Experience Section',
                    'fields' => ['experience_eyebrow', 'experience_title'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'experience',
                    'dynamic_info' => 'Experience items are pulled from Resume/Experience Manager'
                ],
                'education' => [
                    'name' => 'Education Section',
                    'fields' => ['education_eyebrow', 'education_title'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'education',
                    'dynamic_info' => 'Education items are pulled from Resume/Education Manager'
                ],
                'portfolio' => [
                    'name' => 'Portfolio Section',
                    'fields' => ['portfolio_eyebrow', 'portfolio_title', 'portfolio_subtitle'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'portfolio',
                    'dynamic_info' => 'Projects are pulled from Projects Manager'
                ],
                'testimonials' => [
                    'name' => 'Testimonials Section',
                    'fields' => ['testimonials_eyebrow', 'testimonials_title'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'testimonials',
                    'dynamic_info' => 'Testimonials are pulled from Testimonials Manager'
                ],
                'certifications' => [
                    'name' => 'Certifications Section',
                    'fields' => ['certifications_eyebrow', 'certifications_title'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'certifications',
                    'dynamic_info' => 'Certifications are pulled from Certifications Manager'
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

        // 2. ABOUT PAGE
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

        // 3. SERVICES PAGE
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
                    'fields' => ['cta_heading', 'cta_button', 'page_button', 'view_all'],
                ],
            ]
        ];

        // 4. PORTFOLIO PAGE
        $pages['portfolio'] = [
            'name' => 'Portfolio Page',
            'page_key' => 'portfolio',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => ['page_eyebrow', 'page_title', 'page_subtitle'],
                ],
                'filters' => [
                    'name' => 'Filter Labels',
                    'fields' => ['filter_all', 'filter_label'],
                ],
            ]
        ];

        // 5. BLOG PAGE
        $pages['blog'] = [
            'name' => 'Blog Page',
            'page_key' => 'blog',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => ['page_eyebrow', 'page_title', 'page_subtitle'],
                ],
                'sidebar' => [
                    'name' => 'Sidebar',
                    'fields' => ['sidebar_search', 'sidebar_search_placeholder', 'sidebar_categories', 'sidebar_all_categories', 'sidebar_tags', 'sidebar_view_categories', 'filter_label', 'filter_clear', 'empty_text', 'empty_button'],
                ],
            ]
        ];

        // 6. CONTACT PAGE
        $pages['contact'] = [
            'name' => 'Contact Page',
            'page_key' => 'contact',
            'sections' => [
                'page' => [
                    'name' => 'Page Header',
                    'fields' => ['page_eyebrow', 'page_title', 'page_subtitle'],
                ],
                'form' => [
                    'name' => 'Contact Form Labels',
                    'fields' => ['form_phone', 'form_subject', 'form_message', 'form_button'],
                ],
            ]
        ];

        // 7. SEARCH PAGE
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

        // 8. FAQ PAGE
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

        // 9. RESUME PAGE
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

        // 10. PRICING PAGE
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

        // 11. FOOTER - Dynamic content with links from database
        $footerSections = [
            'footer' => [
                'name' => 'Footer Content',
                'fields' => ['tagline', 'quick_links_title', 'contact_title', 'newsletter_title', 'newsletter_text', 'newsletter_placeholder', 'copyright', 'copyright_prefix']
            ],
            'quick_links' => [
                'name' => 'Quick Links',
                'fields' => $footerLinkFields,
                'is_dynamic' => true,
                'dynamic_info' => 'Links are automatically pulled from Footer Menu items'
            ]
        ];
        
        $pages['footer'] = [
            'name' => 'Footer',
            'sections' => $footerSections
        ];

        return $pages;
    }
}

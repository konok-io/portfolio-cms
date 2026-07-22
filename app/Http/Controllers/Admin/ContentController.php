<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        
        return view('admin.content.index', compact('setting', 'content', 'pages'));
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

        // Group by language
        $groupedData = [];
        foreach ($data as $key => $value) {
            $parts = explode('_', $key);
            $suffix = end($parts);
            
            if (in_array($suffix, ['en', 'bn', 'ar'])) {
                $baseKey = str_replace('_' . $suffix, '', $key);
                $groupedData[$baseKey][$suffix] = $value;
                // Set default to English if not already set
                if (!isset($groupedData[$baseKey]['default'])) {
                    $groupedData[$baseKey]['default'] = $value;
                }
            } else {
                $groupedData[$key] = ['default' => $value, 'en' => $value, 'bn' => $value, 'ar' => $value];
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

        return redirect()->back()->with('success', 'Content updated successfully!');
    }

    /**
     * Reset page content to default
     */
    public function reset(Request $request)
    {
        $page = $request->input('page');
        
        $setting = Setting::instance();
        $pageContent = $setting->page_content ?? [];
        unset($pageContent[$page]);
        $setting->page_content = $pageContent;
        $setting->save();

        PageContent::clearCache();

        return redirect()->back()->with('success', 'Content reset to default!');
    }

    /**
     * Get list of all pages with their sections
     */
    private function getPages(): array
    {
        return [
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
                        'fields' => ['tagline', 'quick_links_title', 'newsletter_title', 'newsletter_text', 'newsletter_placeholder', 'copyright']
                    ],
                ]
            ],
        ];
    }
}

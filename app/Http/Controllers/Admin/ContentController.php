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
        $headerNavLinks = $this->getHeaderNavLinks();
        $dynamicItems = $this->getDynamicItems();
        $defaultValues = $this->getDefaultValues();
        
        // Get active tab from query parameter or default to first page
        $activeTab = request('tab', array_key_first($pages));
        
        return view('admin.content.index', compact('setting', 'content', 'pages', 'activeTab', 'footerLinks', 'headerNavLinks', 'dynamicItems', 'defaultValues'));
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
     * Get default values for all locales
     */
    private function getDefaultValues(): array
    {
        return [
            'en' => [
                'site_name' => 'Portfolio CMS',
                'site_tagline' => 'Professional Web Solutions',
                'header_cta_text' => 'Contact Me',
                'header_cta_icon' => 'fa-paper-plane',
                'hero_eyebrow' => 'Available for new projects',
                'hero_button_hire' => 'Hire Me',
                'hero_button_cv' => 'Download CV',
                'hero_badge' => 'Years Experience',
                'typing_text_1' => 'Web Developer',
                'typing_text_2' => 'Laravel Expert',
                'typing_text_3' => 'Full Stack Developer',
                'typing_text_4' => 'UI/UX Enthusiast',
                'typing_text_5' => 'Problem Solver',
                'why_eyebrow' => 'Why Choose Me',
                'why_title' => 'Why Choose Me For Your Next Project?',
                'why_card1_title' => 'Modern Design',
                'why_card1_text' => 'I create beautiful, modern designs that look great on all devices.',
                'why_card2_title' => 'Clean Code',
                'why_card2_text' => 'Well-structured, maintainable code that follows best practices.',
                'why_card3_title' => 'Fast Delivery',
                'why_card3_text' => 'Quick turnaround without compromising quality.',
                'skills_eyebrow' => 'Skills',
                'skills_title' => 'My Expertise',
                'services_eyebrow' => 'Services',
                'services_title' => 'What I Do',
                'services_subtitle' => 'Professional services tailored to your needs',
                'view_all' => 'View All',
                'page_button' => 'Learn More',
                'blog_eyebrow' => 'Blog',
                'blog_title' => 'Latest Articles',
                'blog_button' => 'View All Posts',
                'blog_card_link' => 'Read More',
                'contact_eyebrow' => 'Contact',
                'contact_title' => 'Get In Touch',
                'contact_text' => 'Have a project in mind? Let\'s work together!',
                'contact_label_email' => 'Email',
                'contact_label_phone' => 'Phone',
                'contact_label_location' => 'Location',
                'contact_form_name' => 'Your Name',
                'contact_form_email' => 'Email Address',
                'contact_form_phone' => 'Phone Number',
                'contact_form_subject' => 'Subject',
                'contact_form_message' => 'Your Message',
                'contact_form_button' => 'Send Message',
                'tagline' => 'Building thoughtful, modern web experiences',
                'quick_links_title' => 'Quick Links',
                'newsletter_title' => 'Newsletter',
                'newsletter_text' => 'Subscribe to get the latest updates.',
                'newsletter_placeholder' => 'Your email address',
                'copyright' => 'All rights reserved.',
                'copyright_prefix' => 'Built with Laravel',
                'cta_heading' => 'Ready to start your project?',
                'cta_button' => 'Get Started',
                'view_all' => 'View All',
                'page_button' => 'Learn More',
                'filter_label' => 'Filter',
                'filter_all' => 'All',
                'sidebar_search' => 'Search',
                'sidebar_search_placeholder' => 'Search posts...',
                'sidebar_categories' => 'Categories',
                'sidebar_all_categories' => 'All Categories',
                'sidebar_tags' => 'Tags',
                'sidebar_view_categories' => 'View All Categories',
                'empty_text' => 'No items found.',
                'empty_button' => 'Browse All',
                'form_placeholder' => 'Search...',
                'projects_title' => 'Projects',
                'empty_title' => 'No results found',
                'empty_projects' => 'Browse Projects',
                'empty_blogs' => 'Browse Blog',
                'empty_services' => 'View Services',
            ],
            'bn' => [
                'site_name' => 'পোর্টফোলিও সিএমএস',
                'site_tagline' => 'পেশাদার ওয়েব সমাধান',
                'header_cta_text' => 'যোগাযোগ করুন',
                'header_cta_icon' => 'fa-paper-plane',
                'hero_eyebrow' => 'নতুন প্রজেক্টের জন্য উপলব্ধ',
                'hero_button_hire' => 'আমাকে ভাড়া করুন',
                'hero_button_cv' => 'সিভি ডাউনলোড করুন',
                'hero_badge' => 'বছরের অভিজ্ঞতা',
                'typing_text_1' => 'ওয়েব ডেভেলপার',
                'typing_text_2' => 'লারাভেল বিশেষজ্ঞ',
                'typing_text_3' => 'ফুল স্ট্যাক ডেভেলপার',
                'typing_text_4' => 'ইউআই/ইউএক্স উৎসাহী',
                'typing_text_5' => 'সমস্যা সমাধানকারী',
                'why_eyebrow' => 'কেন আমাকে বেছে নেবেন',
                'why_title' => 'আপনার পরবর্তী প্রজেক্টের জন্য কেন আমাকে বেছে নেবেন?',
                'why_card1_title' => 'আধুনিক ডিজাইন',
                'why_card1_text' => 'আমি সুন্দর, আধুনিক ডিজাইন তৈরি করি যা সব ডিভাইসে দারুণ দেখায়।',
                'why_card2_title' => 'পরিষ্কার কোড',
                'why_card2_text' => 'ভালো অনুশীলন অনুসরণকারী ভালো-কাঠামোগত, রক্ষণাবেক্ষণযোগ্য কোড।',
                'why_card3_title' => 'দ্রুত ডেলিভারি',
                'why_card3_text' => 'গুণমানের সাথে আপোষ না করে দ্রুত টার্নঅ্যারাউন্ড।',
                'skills_eyebrow' => 'দক্ষতা',
                'skills_title' => 'আমার দক্ষতা',
                'services_eyebrow' => 'সেবাসমূহ',
                'services_title' => 'আমি যা করি',
                'services_subtitle' => 'আপনার প্রয়োজন অনুযায়ী পেশাদার সেবা',
                'view_all' => 'সব দেখুন',
                'page_button' => 'আরও জানুন',
                'blog_eyebrow' => 'ব্লগ',
                'blog_title' => 'সাম্প্রতিক লেখা',
                'blog_button' => 'সব পোস্ট দেখুন',
                'blog_card_link' => 'আরও পড়ুন',
                'contact_eyebrow' => 'যোগাযোগ',
                'contact_title' => 'যোগাযোগ করুন',
                'contact_text' => 'একটি প্রজেক্ট মাথায় আছে? চলুন একসাথে কাজ করি!',
                'contact_label_email' => 'ইমেইল',
                'contact_label_phone' => 'ফোন',
                'contact_label_location' => 'ঠিকানা',
                'contact_form_name' => 'আপনার নাম',
                'contact_form_email' => 'ইমেইল ঠিকানা',
                'contact_form_phone' => 'ফোন নম্বর',
                'contact_form_subject' => 'বিষয়',
                'contact_form_message' => 'আপনার বার্তা',
                'contact_form_button' => 'বার্তা পাঠান',
                'tagline' => 'চিন্তাশীল, আধুনিক ওয়েব অভিজ্ঞতা তৈরি করা',
                'quick_links_title' => 'দ্রুত লিংক',
                'newsletter_title' => 'নিউজলেটার',
                'newsletter_text' => 'সর্বশেষ আপডেট পেতে সাবস্ক্রাইব করুন।',
                'newsletter_placeholder' => 'আপনার ইমেইল ঠিকানা',
                'copyright' => 'সর্বস্বত্ব সংরক্ষিত।',
                'copyright_prefix' => 'Laravel দিয়ে তৈরি',
                'cta_heading' => 'আপনার প্রজেক্ট শুরু করতে প্রস্তুত?',
                'cta_button' => 'শুরু করুন',
                'view_all' => 'সব দেখুন',
                'page_button' => 'আরও জানুন',
                'filter_label' => 'ফিল্টার',
                'filter_all' => 'সব',
                'sidebar_search' => 'অনুসন্ধান',
                'sidebar_search_placeholder' => 'পোস্ট অনুসন্ধান করুন...',
                'sidebar_categories' => 'ক্যাটাগরি',
                'sidebar_all_categories' => 'সব ক্যাটাগরি',
                'sidebar_tags' => 'ট্যাগ',
                'sidebar_view_categories' => 'সব ক্যাটাগরি দেখুন',
                'empty_text' => 'কিছু পাওয়া যায়নি।',
                'empty_button' => 'সব দেখুন',
                'form_placeholder' => 'অনুসন্ধান...',
                'projects_title' => 'প্রজেক্ট',
                'empty_title' => 'কিছু পাওয়া যায়নি',
                'empty_projects' => 'প্রজেক্ট দেখুন',
                'empty_blogs' => 'ব্লগ দেখুন',
                'empty_services' => 'সেবা দেখুন',
                'nav_link_1' => 'হোম',
                'nav_link_2' => 'আমার সম্পর্কে',
                'nav_link_3' => 'সেবাসমূহ',
                'nav_link_4' => 'পোর্টফোলিও',
                'nav_link_5' => 'ব্লগ',
                'nav_link_6' => 'যোগাযোগ',
            ],
            'ar' => [
                'site_name' => 'محفظة CMS',
                'site_tagline' => 'حلول الويب المهنية',
                'header_cta_text' => 'تواصل معي',
                'header_cta_icon' => 'fa-paper-plane',
                'hero_eyebrow' => 'متاح لمشاريع جديدة',
                'hero_button_hire' => 'وظفني',
                'hero_button_cv' => 'تحميل السيرة الذاتية',
                'hero_badge' => 'سنوات خبرة',
                'typing_text_1' => 'مطور الويب',
                'typing_text_2' => 'خبير لارافيل',
                'typing_text_3' => 'مطور_full stack',
                'typing_text_4' => 'مهتم بالتصميم',
                'typing_text_5' => 'حل المشكلات',
                'why_eyebrow' => 'لماذا تختارني',
                'why_title' => 'لماذا تختارني لمشروعك القادم؟',
                'why_card1_title' => 'تصميم حديث',
                'why_card1_text' => 'أنشئ تصاميم جميلة وعصرية تبدو رائعة على جميع الأجهزة.',
                'why_card2_title' => 'كود نظيف',
                'why_card2_text' => 'كود جيد التنظيم وقابل للصيانة يتبع أفضل الممارسات.',
                'why_card3_title' => 'توصيل سريع',
                'why_card3_text' => 'دورة سريعة دون المساومة على الجودة.',
                'skills_eyebrow' => 'المهارات',
                'skills_title' => 'خبراتي',
                'services_eyebrow' => 'الخدمات',
                'services_title' => 'ما أفعله',
                'services_subtitle' => 'خدمات احترافية مصممة لاحتياجاتك',
                'view_all' => 'عرض الكل',
                'page_button' => 'اعرف المزيد',
                'blog_eyebrow' => 'المدونة',
                'blog_title' => 'أحدث المقالات',
                'blog_button' => 'عرض جميع المنشورات',
                'blog_card_link' => 'اقرأ المزيد',
                'contact_eyebrow' => 'اتصل',
                'contact_title' => 'تواصل معي',
                'contact_text' => 'هل لديك مشروع في ذهنك؟ لنعمل معاً!',
                'contact_label_email' => 'البريد الإلكتروني',
                'contact_label_phone' => 'الهاتف',
                'contact_label_location' => 'الموقع',
                'contact_form_name' => 'اسمك',
                'contact_form_email' => 'البريد الإلكتروني',
                'contact_form_phone' => 'رقم الهاتف',
                'contact_form_subject' => 'الموضوع',
                'contact_form_message' => 'رسالتك',
                'contact_form_button' => 'إرسال الرسالة',
                'tagline' => 'بناء تجارب ويب حديثة ومThoughtful',
                'quick_links_title' => 'روابط سريعة',
                'newsletter_title' => 'النشرة الإخبارية',
                'newsletter_text' => 'اشترك للحصول على آخر التحديثات.',
                'newsletter_placeholder' => 'بريدك الإلكتروني',
                'copyright' => 'جميع الحقوق محفوظة.',
                'copyright_prefix' => 'مبني بـ Laravel',
                'cta_heading' => 'هل أنت مستعد لبدء مشروعك؟',
                'cta_button' => 'ابدأ الآن',
                'view_all' => 'عرض الكل',
                'page_button' => 'اعرف المزيد',
                'filter_label' => 'تصفية',
                'filter_all' => 'الكل',
                'sidebar_search' => 'بحث',
                'sidebar_search_placeholder' => 'البحث في المنشورات...',
                'sidebar_categories' => 'الفئات',
                'sidebar_all_categories' => 'جميع الفئات',
                'sidebar_tags' => 'الوسوم',
                'sidebar_view_categories' => 'عرض جميع الفئات',
                'empty_text' => 'لم يتم العثور على عناصر.',
                'empty_button' => 'عرض الكل',
                'form_placeholder' => 'بحث...',
                'projects_title' => 'المشاريع',
                'empty_title' => 'لم يتم العثور على نتائج',
                'empty_projects' => 'تصفح المشاريع',
                'empty_blogs' => 'تصفح المدونة',
                'empty_services' => 'عرض الخدمات',
                'nav_link_1' => 'Home',
                'nav_link_2' => 'About',
                'nav_link_3' => 'Services',
                'nav_link_4' => 'Portfolio',
                'nav_link_5' => 'Blog',
                'nav_link_6' => 'Contact',
            ],
        ];
        
        // Check for exact match first
        if (isset($defaults[$locale][$field])) {
            return $defaults[$locale][$field];
        }
        
        // Generate from field name for unknown fields
        return ucwords(str_replace('_', ' ', $field));
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
     * Get header navigation links from menu items
     */
    private function getHeaderNavLinks(): array
    {
        $links = [];
        
        try {
            if (class_exists('App\Models\MenuItem')) {
                $menuItems = MenuItem::active()
                    ->where('menu_type', 'header')
                    ->orderBy('order')
                    ->get();
                    
                foreach ($menuItems as $item) {
                    $links[] = [
                        'title' => $item->name,
                        'url' => $item->link,
                        'type' => 'menu'
                    ];
                }
            }
            
            // Fallback to default nav items if no menu items
            if (empty($links)) {
                $links = [
                    ['title' => 'Home', 'url' => '/', 'type' => 'default'],
                    ['title' => 'About', 'url' => '/about', 'type' => 'default'],
                    ['title' => 'Services', 'url' => '/services', 'type' => 'default'],
                    ['title' => 'Portfolio', 'url' => '/portfolio', 'type' => 'default'],
                    ['title' => 'Blog', 'url' => '/blog', 'type' => 'default'],
                    ['title' => 'Contact', 'url' => '/contact', 'type' => 'default'],
                ];
            }
        } catch (\Throwable $e) {
            // Return default nav items
            $links = [
                ['title' => 'Home', 'url' => '/', 'type' => 'default'],
                ['title' => 'About', 'url' => '/about', 'type' => 'default'],
                ['title' => 'Services', 'url' => '/services', 'type' => 'default'],
                ['title' => 'Portfolio', 'url' => '/portfolio', 'type' => 'default'],
                ['title' => 'Blog', 'url' => '/blog', 'type' => 'default'],
                ['title' => 'Contact', 'url' => '/contact', 'type' => 'default'],
            ];
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
            
            // Services
            if (class_exists('App\Models\Service')) {
                $items['services'] = \App\Models\Service::where('is_active', true)->orderBy('sort_order')->get(['id', 'name', 'slug'])->toArray();
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
        
        // 0. HEADER - Site-wide header content
        $headerNavLinks = $this->getHeaderNavLinks();
        $headerNavFields = [];
        foreach ($headerNavLinks as $index => $link) {
            $fieldKey = 'nav_link_' . ($index + 1);
            $headerNavFields[] = $fieldKey;
        }
        
        $pages['header'] = [
            'name' => 'Header',
            'sections' => [
                'header' => [
                    'name' => 'Site Identity',
                    'fields' => ['site_name', 'site_tagline', 'header_cta_text', 'header_cta_icon'],
                    'is_dynamic' => false,
                ],
                'nav_menu' => [
                    'name' => 'Navigation Menu',
                    'fields' => $headerNavFields,
                    'is_dynamic' => true,
                    'dynamic_type' => 'nav_menu',
                    'dynamic_info' => 'Menu items are pulled from Menu Manager'
                ],
            ]
        ];
        
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
                    'fields' => ['hero_eyebrow', 'hero_button_hire', 'hero_button_cv', 'hero_badge', 'typing_text_1', 'typing_text_2', 'typing_text_3', 'typing_text_4', 'typing_text_5']
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
                    'fields' => ['services_eyebrow', 'services_title', 'services_subtitle', 'view_all', 'page_button'],
                    'is_dynamic' => true,
                    'dynamic_type' => 'services',
                    'dynamic_info' => 'Services are pulled from Services Manager'
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
                    'fields' => ['portfolio_eyebrow', 'portfolio_title', 'portfolio_subtitle', 'filter_all', 'filter_label'],
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
            ],
            'contact_info' => [
                'name' => 'Contact Info',
                'fields' => ['contact_email_label', 'contact_phone_label', 'contact_address_label'],
                'is_dynamic' => false,
                'dynamic_info' => 'Email, Phone, Address values are from Site Settings'
            ]
        ];
        
        $pages['footer'] = [
            'name' => 'Footer',
            'sections' => $footerSections
        ];

        return $pages;
    }
}

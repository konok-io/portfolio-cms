<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class PageContentSeeder extends Seeder
{
    /**
     * Seed default page content for all pages and languages.
     */
    public function run(): void
    {
        $setting = Setting::instance();
        
        $defaultContent = [
            // ==================== HOME PAGE ====================
            'home' => [
                // Hero Section
                'hero_eyebrow' => 'Available for new projects',
                'hero_eyebrow_en' => 'Available for new projects',
                'hero_eyebrow_bn' => 'নতুন প্রজেক্টের জন্য উপলব্ধ',
                'hero_eyebrow_ar' => 'متاح لمشاريع جديدة',
                'hero_button_hire' => 'Hire Me',
                'hero_button_hire_en' => 'Hire Me',
                'hero_button_hire_bn' => 'আমাকে ভাড়া করুন',
                'hero_button_hire_ar' => 'وظفني',
                'hero_button_cv' => 'Download CV',
                'hero_button_cv_en' => 'Download CV',
                'hero_button_cv_bn' => 'সিভি ডাউনলোড করুন',
                'hero_button_cv_ar' => 'تحميل السيرة الذاتية',
                'hero_badge' => 'Years Experience',
                'hero_badge_en' => 'Years Experience',
                'hero_badge_bn' => 'বছরের অভিজ্ঞতা',
                'hero_badge_ar' => 'سنوات الخبرة',
                
                // Why Choose Me Section
                'why_eyebrow' => 'Why Work With Me',
                'why_eyebrow_en' => 'Why Work With Me',
                'why_eyebrow_bn' => 'আমার সাথে কেন কাজ করবেন',
                'why_eyebrow_ar' => 'لماذا تعمل معي',
                'why_title' => 'What sets me apart',
                'why_title_en' => 'What sets me apart',
                'why_title_bn' => 'আমাকে আলাদা করে কী',
                'why_title_ar' => 'ما يميزني',
                'why_card1_title' => 'Clean Code',
                'why_card1_title_en' => 'Clean Code',
                'why_card1_title_bn' => 'পরিষ্কার কোড',
                'why_card1_title_ar' => 'كود نظيف',
                'why_card1_text' => 'Writing maintainable, well-documented code that scales with your business needs.',
                'why_card2_title' => 'On-Time Delivery',
                'why_card2_text' => 'Respecting deadlines and communicating transparently throughout every project.',
                'why_card3_title' => 'Dedicated Support',
                'why_card3_text' => 'Post-launch support and maintenance to keep your project running smoothly.',
                'why_button' => 'Learn More About Me',
                
                // Skills Section
                'skills_title' => 'Technologies I work with',
                'skills_subtitle' => 'A snapshot of the tools and languages I use to bring projects to life.',
                
                // Services Section
                'services_eyebrow' => 'What I Offer',
                'services_title' => 'Services built around your goals',
                'services_subtitle' => 'End-to-end web development services to help your idea reach production.',
                'services_button' => 'Learn More',
                
                // Experience Section
                'experience_title' => 'Work Experience',
                'experience_subtitle' => 'Roles and companies that have shaped how I build software today.',
                
                // Education Section
                'education_title' => 'Education',
                'education_subtitle' => 'My academic foundation in computer science and technology.',
                
                // Portfolio Section
                'portfolio_title' => 'Selected Projects',
                'portfolio_subtitle' => 'A few of the projects I\'ve recently designed and built.',
                'portfolio_button' => 'View All Projects',
                'portfolio_card_link' => 'View Project',
                
                // Testimonials Section
                'testimonials_title' => 'What clients say about working with me',
                'testimonials_video_button' => 'Watch Video',
                
                // Certifications Section
                'certifications_title' => 'Certifications & Badges',
                'certifications_description' => 'Professional certifications and achievements',
                'certifications_verify' => 'Verify',
                
                // Blog Section
                'blog_eyebrow' => 'From the Blog',
                'blog_title' => 'Latest Articles',
                'blog_button' => 'View All Articles',
                'blog_card_link' => 'Read More',
                
                // Contact Section
                'contact_eyebrow' => 'Get In Touch',
                'contact_title' => "Let's build something great together",
                'contact_text' => "Have a project in mind? Fill out the form and I'll get back to you shortly.",
                'contact_label_email' => 'Email',
                'contact_label_phone' => 'Phone',
                'contact_label_location' => 'Location',
                'contact_form_name' => 'Name',
                'contact_form_email' => 'Email',
                'contact_form_phone' => 'Phone',
                'contact_form_subject' => 'Subject',
                'contact_form_message' => 'Message',
                'contact_form_button' => 'Send Message',
            ],
            
            // ==================== ABOUT PAGE ====================
            'about' => [
                'page_eyebrow' => 'Get to know me',
                'page_title' => 'About Me',
                'intro_button' => 'Hire Me',
            ],
            
            // ==================== SERVICES PAGE ====================
            'services' => [
                'page_eyebrow' => 'What I Offer',
                'page_title' => 'Services',
                'page_subtitle' => 'End-to-end web development services to help your idea reach production.',
                'empty_text' => 'No services have been added yet.',
                'cta_heading' => 'Have a project in mind?',
                'cta_button' => 'Get a Quote',
            ],
            
            // ==================== SERVICE DETAIL ====================
            'service_detail' => [
                'sidebar_title' => 'Interested in this service?',
                'sidebar_text' => "Let's discuss your project and see how I can help you achieve your goals.",
                'sidebar_button' => 'Request a Quote',
                'other_services' => 'Other Services',
                'cta_heading' => 'Ready to get started?',
                'cta_text' => "Let's work together to bring your vision to life.",
                'cta_button' => 'Contact Me',
            ],
            
            // ==================== PORTFOLIO PAGE ====================
            'portfolio' => [
                'page_eyebrow' => 'Portfolio',
                'page_title' => 'All Projects',
                'page_subtitle' => 'Browse through a complete collection of my recent work, filtered by category or tag.',
                'filter_all' => 'All',
                'filter_label' => 'Filter:',
                'empty_text' => 'No projects found with the selected filter.',
                'empty_button' => 'View All Projects',
                'card_link' => 'View Project',
                'card_client' => 'Client:',
            ],
            
            // ==================== PROJECT DETAIL ====================
            'project_detail' => [
                'share_title' => 'Share this project',
                'share_text' => "Like this project? Share it with others",
                'video_title' => 'Project Demo',
                'gallery_title' => 'Project Gallery',
                'details_title' => 'Project Details',
                'details_client' => 'Client',
                'details_status' => 'Status',
                'details_category' => 'Category',
                'technologies_title' => 'Technologies Used',
                'tags_title' => 'Tags',
                'views_label' => 'Views',
                'downloads_label' => 'Downloads',
                'live_button' => 'Visit Live Site',
                'related_title' => 'Related Projects',
                'nav_previous' => 'Previous',
                'nav_next' => 'Next',
                'back_button' => 'Back to Portfolio',
            ],
            
            // ==================== BLOG PAGE ====================
            'blog' => [
                'page_eyebrow' => 'Blog',
                'page_title' => 'Latest Articles & Insights',
                'page_subtitle' => 'Thoughts on web development, Laravel, and building better software.',
                'filter_label' => 'Filter:',
                'filter_clear' => 'Clear All',
                'empty_text' => 'No articles found with the selected filter.',
                'empty_button' => 'View All Articles',
                'card_link' => 'Read More',
                'sidebar_search' => 'Search',
                'sidebar_search_placeholder' => 'Search articles...',
                'sidebar_categories' => 'Categories',
                'sidebar_all_categories' => 'All Categories',
                'sidebar_view_categories' => 'View All Categories',
                'sidebar_tags' => 'Popular Tags',
            ],
            
            // ==================== BLOG POST ====================
            'blog_post' => [
                'share_title' => 'Share this article',
                'share_text' => "If you found this helpful, share it with your network",
                'share_facebook' => 'Facebook',
                'share_twitter' => 'Twitter',
                'share_linkedin' => 'LinkedIn',
                'share_whatsapp' => 'WhatsApp',
                'share_copy' => 'Copy',
                'related_title' => 'Related Articles',
                'comments_title' => 'Comments',
                'comment_form_title' => 'Leave a Comment',
                'comment_name' => 'Name *',
                'comment_email' => 'Email *',
                'comment_website' => 'Website',
                'comment_text' => 'Comment *',
                'comment_submit' => 'Post Comment',
                'comment_note' => 'Your comment will be reviewed before publishing.',
                'no_comments' => "No comments yet. Be the first to share your thoughts!",
                'sidebar_about' => 'About the Author',
                'sidebar_contact' => 'Get in Touch',
                'back_button' => 'Back to Blog',
            ],
            
            // ==================== CONTACT PAGE ====================
            'contact' => [
                'page_eyebrow' => 'Get In Touch',
                'page_title' => "Let's Work Together",
                'page_subtitle' => 'Have a project in mind? Fill out the form below and I\'ll get back to you within 24 hours.',
                'form_name' => 'Your Name',
                'form_email' => 'Email Address',
                'form_phone' => 'Phone Number',
                'form_subject' => 'Subject',
                'form_message' => 'Your Message',
                'form_button' => 'Send Message',
                'info_title' => 'Contact Information',
                'info_email' => 'Email',
                'info_phone' => 'Phone',
                'info_address' => 'Address',
                'map_placeholder' => 'Map location will appear here',
            ],
            
            // ==================== SEARCH PAGE ====================
            'search' => [
                'page_title' => 'Search Results',
                'form_placeholder' => 'Search projects, blogs, services...',
                'projects_title' => 'Projects',
                'blogs_title' => 'Blog Posts',
                'services_title' => 'Services',
                'pages_title' => 'Pages',
                'empty_title' => 'No results found',
                'empty_text' => 'Try different keywords or browse our sections',
                'empty_projects' => 'Browse Projects',
                'empty_blogs' => 'Browse Blog',
                'empty_services' => 'Browse Services',
            ],
            
            // ==================== FOOTER ====================
            'footer' => [
                'tagline' => 'Building thoughtful, modern web experiences — from idea to launch.',
                'quick_links_title' => 'Quick Links',
                'newsletter_title' => 'Newsletter',
                'newsletter_text' => 'Get notified about new projects and blog posts.',
                'newsletter_placeholder' => 'Your email',
                'copyright' => 'All rights reserved.',
                'copyright_prefix' => 'Built with Laravel',
            ],
            
            // ==================== COMMON ====================
            'common' => [
                'loading' => 'Loading...',
                'error' => 'An error occurred.',
                'success' => 'Success!',
                'home' => 'Home',
                'back' => 'Back',
                'view' => 'View',
                'close' => 'Close',
                'next' => 'Next',
                'previous' => 'Previous',
            ],
        ];
        
        $setting->page_content = $defaultContent;
        $setting->save();
        
        $this->command->info('Page content seeded successfully!');
    }
}

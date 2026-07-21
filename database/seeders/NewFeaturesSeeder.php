<?php

namespace Database\Seeders;

use App\Models\Certification;
use App\Models\CustomPage;
use App\Models\Faq;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\ResumeSetting;
use App\Models\Statistic;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class NewFeaturesSeeder extends Seeder
{
    public function run(): void
    {
        // Statistics
        $stats = [
            ['title' => 'Projects Completed', 'icon' => 'fa fa-briefcase', 'value' => 150, 'prefix' => '', 'suffix' => '+', 'sort_order' => 1],
            ['title' => 'Happy Clients', 'icon' => 'fa fa-smile', 'value' => 98, 'prefix' => '', 'suffix' => '%', 'sort_order' => 2],
            ['title' => 'Years Experience', 'icon' => 'fa fa-calendar', 'value' => 5, 'prefix' => '', 'suffix' => '+', 'sort_order' => 3],
            ['title' => 'Awards Won', 'icon' => 'fa fa-trophy', 'value' => 12, 'prefix' => '', 'suffix' => '', 'sort_order' => 4],
        ];

        foreach ($stats as $stat) {
            Statistic::firstOrCreate(['title' => $stat['title']], $stat);
        }

        // FAQs
        $faqs = [
            ['question' => 'What services do you offer?', 'answer' => 'I offer web development, mobile app development, UI/UX design, and digital marketing services.', 'sort_order' => 1],
            ['question' => 'How can I contact you?', 'answer' => 'You can contact me through the contact form on this website or via email at admin@konok.io', 'sort_order' => 2],
            ['question' => 'What is your pricing structure?', 'answer' => 'My pricing depends on the project scope and requirements. Please contact me for a free quote.', 'sort_order' => 3],
        ];

        foreach ($faqs as $faq) {
            Faq::firstOrCreate(['question' => $faq['question']], $faq);
        }

        // Pricing Plans
        $plans = [
            [
                'name' => 'Basic',
                'description' => 'Perfect for small projects',
                'monthly_price' => 99,
                'yearly_price' => 990,
                'features' => json_encode(['5 Pages', 'Responsive Design', 'Basic SEO', 'Contact Form', 'Email Support']),
                'is_highlighted' => false,
                'sort_order' => 1,
            ],
            [
                'name' => 'Professional',
                'description' => 'Best for growing businesses',
                'monthly_price' => 199,
                'yearly_price' => 1990,
                'features' => json_encode(['15 Pages', 'Responsive Design', 'Advanced SEO', 'Contact Form', 'Social Media Integration', 'Priority Support']),
                'is_highlighted' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Enterprise',
                'description' => 'For large scale projects',
                'monthly_price' => 499,
                'yearly_price' => 4990,
                'features' => json_encode(['Unlimited Pages', 'Responsive Design', 'Advanced SEO', 'E-commerce Ready', 'Custom Features', '24/7 Support']),
                'is_highlighted' => false,
                'sort_order' => 3,
            ],
        ];

        foreach ($plans as $plan) {
            PricingPlan::firstOrCreate(['name' => $plan['name']], $plan);
        }

        // Certifications
        $certs = [
            ['name' => 'Laravel Developer Certification', 'issuer' => 'Laravel', 'issue_date' => '2024-01-15', 'description' => 'Certified Laravel Developer'],
            ['name' => 'Full Stack Developer', 'issuer' => 'Meta', 'issue_date' => '2023-06-20', 'description' => 'Meta Full Stack Developer Certificate'],
        ];

        foreach ($certs as $cert) {
            Certification::firstOrCreate(['name' => $cert['name']], $cert);
        }

        // Tags
        $tags = [
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'React', 'slug' => 'react'],
            ['name' => 'Vue.js', 'slug' => 'vue'],
            ['name' => 'Mobile App', 'slug' => 'mobile-app'],
        ];

        foreach ($tags as $tag) {
            Tag::firstOrCreate(['slug' => $tag['slug']], $tag);
        }

        // Custom Pages
        $pages = [
            [
                'title' => 'Privacy Policy',
                'slug' => 'privacy-policy',
                'template' => 'default',
                'content' => '<h2>Privacy Policy</h2><p>Your privacy is important to us. This policy explains how we collect, use, and protect your information.</p><h3>Information We Collect</h3><p>We collect information you provide directly to us, such as when you fill out a form or contact us.</p><h3>How We Use Your Information</h3><p>We use the information to provide, maintain, and improve our services.</p>',
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'Read our privacy policy',
                'is_published' => true,
                'show_in_footer' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Terms of Service',
                'slug' => 'terms-of-service',
                'template' => 'default',
                'content' => '<h2>Terms of Service</h2><p>By using our services, you agree to these terms and conditions.</p><h3>Services</h3><p>We provide web development and design services as described on our website.</p><h3>Payment Terms</h3><p>Payment terms are agreed upon before project commencement.</p>',
                'meta_title' => 'Terms of Service',
                'meta_description' => 'Read our terms of service',
                'is_published' => true,
                'show_in_footer' => true,
                'sort_order' => 2,
            ],
        ];

        foreach ($pages as $page) {
            CustomPage::firstOrCreate(['slug' => $page['slug']], $page);
        }

        // Resume Settings
        ResumeSetting::firstOrCreate(
            ['id' => 1],
            [
                'template' => 'modern',
                'primary_color' => '#2563eb',
                'show_photo' => true,
                'show_summary' => true,
                'show_skills' => true,
                'show_education' => true,
                'show_experience' => true,
                'show_projects' => false,
                'show_certifications' => true,
            ]
        );

        $this->command->info('New features seeded successfully!');
    }
}

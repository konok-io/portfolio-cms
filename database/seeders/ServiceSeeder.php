<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Application Development',
                'slug' => 'web-application-development',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
                'description' => 'Custom, scalable web applications built with Laravel and modern front-end frameworks.',
                'content' => '<p>I build custom, scalable web applications tailored to your business needs. Using modern frameworks and best practices, I deliver robust solutions that grow with your business.</p><h4>What I Offer:</h4><ul><li>Custom web application development</li><li>Laravel & PHP development</li><li>Vue.js & React frontends</li><li>Database design & optimization</li><li>API development & integration</li></ul>',
            ],
            [
                'name' => 'API Development & Integration',
                'slug' => 'api-development-integration',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="16" y="16" width="6" height="6" rx="1"/><rect x="2" y="16" width="6" height="6" rx="1"/><rect x="9" y="2" width="6" height="6" rx="1"/><path d="M5 16v-3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3"/><path d="M12 12V8"/></svg>',
                'description' => 'Robust REST APIs designed for performance, security, and easy third-party integration.',
                'content' => '<p>I design and develop robust REST APIs that power your applications and enable seamless third-party integrations.</p><h4>Services Include:</h4><ul><li>RESTful API development</li><li>GraphQL APIs</li><li>Third-party API integration</li><li>Payment gateway integration</li><li>API documentation</li></ul>',
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 19l7-7 3 3-7 7-3-3z"/><path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/><path d="M2 2l7.586 7.586"/><circle cx="11" cy="11" r="2"/></svg>',
                'description' => 'Clean, modern, and user-friendly interface design focused on conversion and usability.',
                'content' => '<p>I create beautiful, user-friendly interfaces that engage visitors and drive conversions. My designs prioritize usability and accessibility.</p><h4>Design Services:</h4><ul><li>UI/UX wireframing & prototyping</li><li>Responsive design</li><li>Design systems</li><li>Accessibility compliance</li><li>Figma to code conversion</li></ul>',
            ],
            [
                'name' => 'E-Commerce Solutions',
                'slug' => 'e-commerce-solutions',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>',
                'description' => 'End-to-end online store development including payments, inventory, and order management.',
                'content' => '<p>I build complete e-commerce solutions that help you sell online effectively. From product management to payment processing, I handle it all.</p><h4>Features:</h4><ul><li>Product catalog management</li><li>Shopping cart & checkout</li><li>Payment gateway integration</li><li>Order management</li><li>Inventory tracking</li></ul>',
            ],
            [
                'name' => 'SEO Optimization',
                'slug' => 'seo-optimization',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="M21 21l-4.35-4.35"/><path d="M11 8v6"/><path d="M8 11h6"/></svg>',
                'description' => 'On-page SEO best practices to help your website rank and reach the right audience.',
                'content' => '<p>I optimize your website for search engines to improve visibility and drive organic traffic. My SEO strategies follow latest best practices.</p><h4>SEO Services:</h4><ul><li>Keyword research & analysis</li><li>On-page SEO optimization</li><li>Technical SEO audit</li><li>Meta tag optimization</li><li>Performance optimization</li></ul>',
            ],
            [
                'name' => 'Maintenance & Support',
                'slug' => 'maintenance-support',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>',
                'description' => 'Ongoing support, updates, and performance monitoring for your existing applications.',
                'content' => '<p>I provide ongoing maintenance and support to keep your applications running smoothly. Regular updates, security patches, and performance monitoring included.</p><h4>Support Services:</h4><ul><li>Regular updates & patches</li><li>Security monitoring</li><li>Performance optimization</li><li>Bug fixes</li><li>Technical support</li></ul>',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'name' => $service['name'],
                    'icon' => null,
                    'svg_icon' => $service['svg_icon'],
                    'description' => $service['description'],
                    'content' => $service['content'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}

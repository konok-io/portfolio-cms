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
                'icon' => 'fa-solid fa-laptop-code',
                'description' => 'Custom, scalable web applications built with Laravel and modern front-end frameworks.',
                'content' => '<p>I build custom, scalable web applications tailored to your business needs. Using modern frameworks and best practices, I deliver robust solutions that grow with your business.</p><h4>What I Offer:</h4><ul><li>Custom web application development</li><li>Laravel & PHP development</li><li>Vue.js & React frontends</li><li>Database design & optimization</li><li>API development & integration</li></ul>',
            ],
            [
                'name' => 'API Development & Integration',
                'slug' => 'api-development-integration',
                'icon' => 'fa-solid fa-network-wired',
                'description' => 'Robust REST APIs designed for performance, security, and easy third-party integration.',
                'content' => '<p>I design and develop robust REST APIs that power your applications and enable seamless third-party integrations.</p><h4>Services Include:</h4><ul><li>RESTful API development</li><li>GraphQL APIs</li><li>Third-party API integration</li><li>Payment gateway integration</li><li>API documentation</li></ul>',
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'icon' => 'fa-solid fa-pen-ruler',
                'description' => 'Clean, modern, and user-friendly interface design focused on conversion and usability.',
                'content' => '<p>I create beautiful, user-friendly interfaces that engage visitors and drive conversions. My designs prioritize usability and accessibility.</p><h4>Design Services:</h4><ul><li>UI/UX wireframing & prototyping</li><li>Responsive design</li><li>Design systems</li><li>Accessibility compliance</li><li>Figma to code conversion</li></ul>',
            ],
            [
                'name' => 'E-Commerce Solutions',
                'slug' => 'e-commerce-solutions',
                'icon' => 'fa-solid fa-cart-shopping',
                'description' => 'End-to-end online store development including payments, inventory, and order management.',
                'content' => '<p>I build complete e-commerce solutions that help you sell online effectively. From product management to payment processing, I handle it all.</p><h4>Features:</h4><ul><li>Product catalog management</li><li>Shopping cart & checkout</li><li>Payment gateway integration</li><li>Order management</li><li>Inventory tracking</li></ul>',
            ],
            [
                'name' => 'SEO Optimization',
                'slug' => 'seo-optimization',
                'icon' => 'fa-solid fa-magnifying-glass-chart',
                'description' => 'On-page SEO best practices to help your website rank and reach the right audience.',
                'content' => '<p>I optimize your website for search engines to improve visibility and drive organic traffic. My SEO strategies follow latest best practices.</p><h4>SEO Services:</h4><ul><li>Keyword research & analysis</li><li>On-page SEO optimization</li><li>Technical SEO audit</li><li>Meta tag optimization</li><li>Performance optimization</li></ul>',
            ],
            [
                'name' => 'Maintenance & Support',
                'slug' => 'maintenance-support',
                'icon' => 'fa-solid fa-screwdriver-wrench',
                'description' => 'Ongoing support, updates, and performance monitoring for your existing applications.',
                'content' => '<p>I provide ongoing maintenance and support to keep your applications running smoothly. Regular updates, security patches, and performance monitoring included.</p><h4>Support Services:</h4><ul><li>Regular updates & patches</li><li>Security monitoring</li><li>Performance optimization</li><li>Bug fixes</li><li>Technical support</li></ul>',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::updateOrCreate(
                ['slug' => $service['slug']],
                [
                    'name' => $service['name'],
                    'icon' => $service['icon'],
                    'description' => $service['description'],
                    'content' => $service['content'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}

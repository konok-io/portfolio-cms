<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'Web Application Development',
                'icon' => 'fa-solid fa-laptop-code',
                'description' => 'Custom, scalable web applications built with Laravel and modern front-end frameworks.',
            ],
            [
                'name' => 'API Development & Integration',
                'icon' => 'fa-solid fa-network-wired',
                'description' => 'Robust REST APIs designed for performance, security, and easy third-party integration.',
            ],
            [
                'name' => 'UI/UX Design',
                'icon' => 'fa-solid fa-pen-ruler',
                'description' => 'Clean, modern, and user-friendly interface design focused on conversion and usability.',
            ],
            [
                'name' => 'E-Commerce Solutions',
                'icon' => 'fa-solid fa-cart-shopping',
                'description' => 'End-to-end online store development including payments, inventory, and order management.',
            ],
            [
                'name' => 'SEO Optimization',
                'icon' => 'fa-solid fa-magnifying-glass-chart',
                'description' => 'On-page SEO best practices to help your website rank and reach the right audience.',
            ],
            [
                'name' => 'Maintenance & Support',
                'icon' => 'fa-solid fa-screwdriver-wrench',
                'description' => 'Ongoing support, updates, and performance monitoring for your existing applications.',
            ],
        ];

        foreach ($services as $index => $service) {
            Service::firstOrCreate(
                ['name' => $service['name']],
                [
                    'icon' => $service['icon'],
                    'description' => $service['description'],
                    'sort_order' => $index,
                    'is_active' => true,
                ]
            );
        }
    }
}

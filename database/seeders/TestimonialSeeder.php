<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        if (Testimonial::count() > 0) {
            return;
        }

        $testimonials = [
            [
                'client_name' => 'Sarah Johnson',
                'company' => 'BrightPath Inc.',
                'rating' => 5,
                'review' => 'An absolute pleasure to work with. Delivered our project ahead of schedule with excellent attention to detail. The code quality was outstanding and well-documented.',
            ],
            [
                'client_name' => 'Michael Chen',
                'company' => 'NovaTech Solutions',
                'rating' => 5,
                'review' => 'Communication was clear throughout, and the final product exceeded our expectations. Highly recommended for any web development project.',
            ],
            [
                'client_name' => 'Emily Davis',
                'company' => 'GreenLeaf Marketing',
                'rating' => 5,
                'review' => 'Professional, responsive, and skilled. Our website looks modern and performs great. Very happy with the results!',
            ],
            [
                'client_name' => 'David Wilson',
                'company' => 'TechStart Labs',
                'rating' => 5,
                'review' => 'Exceptional work on our e-commerce platform. The attention to user experience and performance optimization was remarkable.',
            ],
            [
                'client_name' => 'Jessica Martinez',
                'company' => 'Bloom Digital Agency',
                'rating' => 5,
                'review' => 'Transformed our outdated website into a modern, fast, and user-friendly platform. Our traffic increased by 200%!',
            ],
            [
                'client_name' => 'Robert Taylor',
                'company' => 'DataFlow Systems',
                'rating' => 4,
                'review' => 'Great technical skills and problem-solving ability. Delivered a complex dashboard application that our team loves.',
            ],
            [
                'client_name' => 'Amanda Lee',
                'company' => 'Creative Minds Studio',
                'rating' => 5,
                'review' => 'Outstanding Laravel development skills. Built us a custom CMS that perfectly matches our workflow needs.',
            ],
            [
                'client_name' => 'Chris Thompson',
                'company' => 'LaunchPad Ventures',
                'rating' => 5,
                'review' => 'Fast, reliable, and very professional. Our MVP was ready in just 3 weeks. Will definitely work together again!',
            ],
            [
                'client_name' => 'Rachel Kim',
                'company' => 'NexGen Finance',
                'rating' => 5,
                'review' => 'Excellent work on our financial dashboard. Clean code, great communication, and on-time delivery every time.',
            ],
            [
                'client_name' => 'James Anderson',
                'company' => 'CloudScale Solutions',
                'rating' => 5,
                'review' => 'Helped us migrate to a modern tech stack seamlessly. The new system is faster, more secure, and easier to maintain.',
            ],
            [
                'client_name' => 'Sophia Garcia',
                'company' => 'Wellness First Clinic',
                'rating' => 5,
                'review' => 'Built us a beautiful patient management system. The interface is intuitive and our staff adapted quickly.',
            ],
            [
                'client_name' => 'Kevin Brown',
                'company' => 'ScaleUp Partners',
                'rating' => 4,
                'review' => 'Very knowledgeable about full-stack development. Our custom CRM works flawlessly and has streamlined our operations.',
            ],
        ];

        foreach ($testimonials as $index => $testimonial) {
            Testimonial::create([
                'client_name' => $testimonial['client_name'],
                'company' => $testimonial['company'],
                'rating' => $testimonial['rating'],
                'review' => $testimonial['review'],
                'is_active' => true,
                'sort_order' => $index,
            ]);
        }
    }
}

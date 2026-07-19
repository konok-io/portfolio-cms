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
                'review' => 'An absolute pleasure to work with. Delivered our project ahead of schedule with excellent attention to detail.',
            ],
            [
                'client_name' => 'Michael Chen',
                'company' => 'NovaTech Solutions',
                'rating' => 5,
                'review' => 'Communication was clear throughout, and the final product exceeded our expectations. Highly recommended.',
            ],
            [
                'client_name' => 'Emily Davis',
                'company' => 'GreenLeaf Marketing',
                'rating' => 4,
                'review' => 'Professional, responsive, and skilled. Our website looks modern and performs great.',
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

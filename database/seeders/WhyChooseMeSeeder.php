<?php

namespace Database\Seeders;

use App\Models\WhyChooseMe;
use Illuminate\Database\Seeder;

class WhyChooseMeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'icon' => 'fa-solid fa-lightbulb',
                'title' => 'Modern Design',
                'description' => 'I create beautiful, modern designs that look great on all devices and browsers.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'icon' => 'fa-solid fa-code',
                'title' => 'Clean Code',
                'description' => 'Well-structured, maintainable code that follows best practices and industry standards.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'icon' => 'fa-solid fa-rocket',
                'title' => 'Fast Delivery',
                'description' => 'Quick turnaround without compromising quality. Your project delivered on time.',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            WhyChooseMe::create($item);
        }
    }
}

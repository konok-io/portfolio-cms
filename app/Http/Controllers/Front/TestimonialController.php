<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\View\View;

class TestimonialController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::active()
            ->orderBy('sort_order')
            ->get();

        return view('front.testimonials.index', compact('testimonials'));
    }
}

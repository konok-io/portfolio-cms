<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        // Use a fallback empty About object so views never get null
        $about = About::first() ?? new About([
            'name'        => 'Your Name',
            'title'       => 'Web Developer',
            'short_intro' => 'Welcome to my portfolio.',
        ]);

        $skills       = Skill::active()->ordered()->get();
        $services     = Service::active()->ordered()->get();
        $experiences  = Experience::ordered()->get();
        $educations   = Education::ordered()->get();
        $projects     = Project::active()->ordered()->with('category')->take(8)->get();
        $testimonials = Testimonial::active()->ordered()->get();
        $blogs        = Blog::published()->with('category')->latest('published_at')->take(3)->get();

        return view('front.home', compact(
            'about',
            'skills',
            'services',
            'experiences',
            'educations',
            'projects',
            'testimonials',
            'blogs'
        ));
    }
}

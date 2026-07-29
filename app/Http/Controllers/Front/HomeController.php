<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Faq;
use App\Models\PricingPlan;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\WhyChooseMe;

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

        // Get site settings for contact section map
        $siteSetting = Setting::instance();

        $skills         = Skill::active()->ordered()->get();
        $services       = Service::active()->ordered()->take(6)->get();
        $experiences    = Experience::ordered()->get();
        $educations     = Education::ordered()->get();
        $projects       = Project::active()->ordered()->with('category')->take(4)->get();
        $testimonials   = Testimonial::active()->ordered()->get();
        $blogs          = Blog::published()->with('category')->latest('published_at')->take(3)->get();
        $certifications = Certification::where('is_active', true)->orderBy('sort_order')->get();
        $whyChooseMe    = WhyChooseMe::getActive();
        
        // FAQ, Pricing, and Resume data for home page sections
        $faqs           = Faq::getActive()->take(4);
        $pricingPlans  = PricingPlan::getActive()->take(3);

        // Skills section titles from page_content
        $locale = app()->getLocale();
        $skillsSectionTitle = page_content('home', 'skills_eyebrow', $locale) ?: 'My Skills';
        $skillsTitle = page_content('home', 'skills_title', $locale) ?: 'Technologies I Work With';
        $skillsSubtitle = page_content('home', 'skills_subtitle', $locale) ?: 'A snapshot of the tools and languages I use to bring projects to life.';

        // Why Choose Me section titles
        $whyChooseMeTitle = page_content('home', 'why_title', $locale) ?: 'Why Choose Me For Your Next Project?';
        $whyChooseMeSubtitle = page_content('home', 'why_subtitle', $locale) ?: 'Discover what sets me apart and why clients trust me with their projects.';

        return view('front.home', compact(
            'about',
            'siteSetting',
            'skills',
            'services',
            'experiences',
            'educations',
            'projects',
            'testimonials',
            'blogs',
            'certifications',
            'skillsSectionTitle',
            'skillsTitle',
            'skillsSubtitle',
            'whyChooseMe',
            'whyChooseMeTitle',
            'whyChooseMeSubtitle',
            'faqs',
            'pricingPlans'
        ));
    }
}

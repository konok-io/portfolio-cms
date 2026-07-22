<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Blog;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\ResumeSetting;
use App\Models\Service;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index(Request $request)
    {
        $settings = ResumeSetting::instance();
        $about = About::first() ?? new About([
            'name' => 'Your Name',
            'title' => 'Web Developer',
            'short_intro' => 'Professional summary.',
        ]);
        
        $skills = Skill::active()->ordered()->get();
        $experiences = Experience::ordered()->get();
        $educations = Education::ordered()->get();
        $projects = Project::active()->ordered()->with('category')->limit(5)->get();
        $certifications = Certification::where('is_active', true)->orderBy('sort_order')->get();

        return view('front.resume.index', compact(
            'settings',
            'about',
            'skills',
            'experiences',
            'educations',
            'projects',
            'certifications'
        ));
    }

    public function preview(Request $request)
    {
        $settings = ResumeSetting::instance();
        $about = About::first() ?? new About([
            'name' => 'Your Name',
            'title' => 'Web Developer',
            'short_intro' => 'Professional summary.',
        ]);
        
        $skills = Skill::active()->ordered()->get();
        $experiences = Experience::ordered()->get();
        $educations = Education::ordered()->get();
        $projects = Project::active()->ordered()->limit(5)->get();
        $certifications = Certification::where('is_active', true)->orderBy('sort_order')->get();

        // Allow template override from request, fallback to settings
        $template = $request->get('template') ?? $settings->template ?? 'modern';
        
        // Validate template
        $validTemplates = ['modern', 'creative', 'tech', 'corporate'];
        if (!in_array($template, $validTemplates)) {
            $template = 'modern';
        }
        
        return view("front.resume-templates.{$template}-preview", compact(
            'settings',
            'about',
            'skills',
            'experiences',
            'educations',
            'projects',
            'certifications'
        ));
    }
}

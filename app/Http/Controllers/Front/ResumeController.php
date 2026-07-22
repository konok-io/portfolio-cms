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

class ResumeController extends Controller
{
    public function index()
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

    public function preview()
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

        $template = $settings->template ?? 'modern';
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

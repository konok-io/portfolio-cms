<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use App\Models\Certification;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Skill;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    protected $cacheMinutes = 60;
    
    public function index()
    {
        return response()->json([
            'name' => 'Portfolio CMS API',
            'version' => '1.0',
            'endpoints' => [
                'GET /api/about' => 'Get about information',
                'GET /api/skills' => 'Get all skills',
                'GET /api/services' => 'Get all services',
                'GET /api/projects' => 'Get all projects',
                'GET /api/projects/{slug}' => 'Get single project',
                'GET /api/blogs' => 'Get all blog posts',
                'GET /api/blogs/{slug}' => 'Get single blog post',
                'GET /api/testimonials' => 'Get all testimonials',
                'GET /api/experience' => 'Get work experience',
                'GET /api/education' => 'Get education history',
                'GET /api/certifications' => 'Get certifications',
                'GET /api/settings' => 'Get site settings',
            ],
        ]);
    }
    
    public function about()
    {
        $about = Cache::remember('api_about', $this->cacheMinutes, function () {
            return About::first();
        });
        
        return response()->json($about);
    }
    
    public function skills()
    {
        $skills = Cache::remember('api_skills', $this->cacheMinutes, function () {
            return Skill::where('is_active', true)->orderBy('position')->get();
        });
        
        return response()->json($skills);
    }
    
    public function services()
    {
        $services = Cache::remember('api_services', $this->cacheMinutes, function () {
            return Service::where('is_active', true)->orderBy('position')->get();
        });
        
        return response()->json($services);
    }
    
    public function projects()
    {
        $projects = Cache::remember('api_projects', $this->cacheMinutes, function () {
            return Project::with(['category', 'tags'])
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get();
        });
        
        return response()->json($projects);
    }
    
    public function project($slug)
    {
        $project = Cache::remember("api_project_{$slug}", $this->cacheMinutes, function () use ($slug) {
            return Project::with(['category', 'tags'])
                ->where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();
        });
        
        return response()->json($project);
    }
    
    public function blogs()
    {
        $blogs = Cache::remember('api_blogs', $this->cacheMinutes, function () {
            return Blog::with(['category', 'tags'])
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get();
        });
        
        return response()->json($blogs);
    }
    
    public function blog($slug)
    {
        $blog = Cache::remember("api_blog_{$slug}", $this->cacheMinutes, function () use ($slug) {
            return Blog::with(['category', 'tags'])
                ->where('slug', $slug)
                ->where('is_published', true)
                ->firstOrFail();
        });
        
        return response()->json($blog);
    }
    
    public function testimonials()
    {
        $testimonials = Cache::remember('api_testimonials', $this->cacheMinutes, function () {
            return Testimonial::where('is_active', true)->orderBy('position')->get();
        });
        
        return response()->json($testimonials);
    }
    
    public function experience()
    {
        $experience = Cache::remember('api_experience', $this->cacheMinutes, function () {
            return Experience::where('is_active', true)->orderBy('start_date', 'desc')->get();
        });
        
        return response()->json($experience);
    }
    
    public function education()
    {
        $education = Cache::remember('api_education', $this->cacheMinutes, function () {
            return Education::where('is_active', true)->orderBy('start_date', 'desc')->get();
        });
        
        return response()->json($education);
    }
    
    public function certifications()
    {
        $certifications = Cache::remember('api_certifications', $this->cacheMinutes, function () {
            return Certification::where('is_active', true)->orderBy('issue_date', 'desc')->get();
        });
        
        return response()->json($certifications);
    }
    
    public function settings()
    {
        $settings = Cache::remember('api_settings', $this->cacheMinutes, function () {
            $setting = Setting::instance();
            return [
                'site_name' => $setting->site_name,
                'email' => $setting->email,
                'phone' => $setting->phone,
                'address' => $setting->address,
                'social' => [
                    'facebook' => $setting->facebook,
                    'twitter' => $setting->twitter,
                    'linkedin' => $setting->linkedin,
                    'github' => $setting->github,
                    'instagram' => $setting->instagram,
                    'youtube' => $setting->youtube,
                ],
            ];
        });
        
        return response()->json($settings);
    }
}

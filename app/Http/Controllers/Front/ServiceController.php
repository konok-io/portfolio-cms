<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $about = About::first() ?? new About([
            'name'  => 'Your Name',
            'title' => 'Web Developer',
        ]);

        $services = Service::active()->ordered()->get();

        return view('front.services', compact('about', 'services'));
    }
    
    public function show(Request $request, $slug)
    {
        $about = About::first() ?? new About([
            'name'  => 'Your Name',
            'title' => 'Web Developer',
        ]);
        
        $service = Service::where('slug', $slug)->first();
        
        if (!$service) {
            abort(404);
        }
            
        $relatedServices = Service::active()
            ->ordered()
            ->where('id', '!=', $service->id)
            ->limit(3)
            ->get();
            
        return view('front.services.show', compact('about', 'service', 'relatedServices'));
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Service;

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
}

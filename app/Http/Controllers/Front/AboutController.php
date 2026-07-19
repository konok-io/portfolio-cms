<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first() ?? new About([
            'name'        => 'Your Name',
            'title'       => 'Web Developer',
            'short_intro' => 'Welcome to my portfolio.',
        ]);

        $skills      = Skill::active()->ordered()->get();
        $experiences = Experience::ordered()->get();
        $educations  = Education::ordered()->get();

        return view('front.about', compact('about', 'skills', 'experiences', 'educations'));
    }
}

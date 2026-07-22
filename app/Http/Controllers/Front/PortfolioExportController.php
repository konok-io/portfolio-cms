<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Skill;
use App\Models\Project;
use App\Models\Service;
use App\Models\Certification;
use Barryvdh\DomPDF\Facade\Pdf;

class PortfolioExportController extends Controller
{
    public function export()
    {
        $about = About::first();
        $experiences = Experience::ordered()->get();
        $education = Education::ordered()->get();
        $skills = Skill::ordered()->get();
        $projects = Project::active()->ordered()->limit(8)->get();
        $services = Service::active()->ordered()->get();
        $certifications = Certification::ordered()->get();

        $data = compact('about', 'experiences', 'education', 'skills', 'projects', 'services', 'certifications');

        $pdf = Pdf::loadView('front.portfolio-pdf', $data);
        
        $filename = 'portfolio-' . ($about->name ? \Illuminate\Support\Str::slug($about->name) : 'download') . '.pdf';

        return $pdf->download($filename);
    }

    public function preview()
    {
        $about = About::first();
        $experiences = Experience::ordered()->get();
        $education = Education::ordered()->get();
        $skills = Skill::ordered()->get();
        $projects = Project::active()->ordered()->limit(8)->get();
        $services = Service::active()->ordered()->get();
        $certifications = Certification::ordered()->get();

        return view('front.portfolio-pdf', compact(
            'about', 'experiences', 'education', 'skills', 'projects', 'services', 'certifications'
        ));
    }
}

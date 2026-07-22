<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ResumeSetting;
use App\Models\About;
use App\Models\Skill;
use App\Models\Experience;
use App\Models\Education;
use App\Models\Project;
use App\Models\Certification;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class ResumeController extends Controller
{
    /**
     * Display resume settings
     */
    public function index()
    {
        $settings = ResumeSetting::instance();
        return view('admin.resume.index', compact('settings'));
    }

    /**
     * Update resume settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'template' => 'required|in:modern,creative,tech,corporate',
            'primary_color' => 'required|hex_color',
            'heading_color' => 'nullable|hex_color',
            'text_color' => 'nullable|hex_color',
            'background_color' => 'nullable|hex_color',
            'header_bg_color' => 'nullable|hex_color',
            'header_text_color' => 'nullable|hex_color',
            'footer_bg_color' => 'nullable|hex_color',
            'include_photo' => 'nullable|boolean',
            'include_skills' => 'nullable|boolean',
            'include_experience' => 'nullable|boolean',
            'include_education' => 'nullable|boolean',
            'include_projects' => 'nullable|boolean',
            'include_certifications' => 'nullable|boolean',
        ]);

        $settings = ResumeSetting::instance();
        $settings->update([
            'template' => $request->template,
            'primary_color' => $request->primary_color,
            'heading_color' => $request->heading_color,
            'text_color' => $request->text_color,
            'background_color' => $request->background_color,
            'header_bg_color' => $request->header_bg_color,
            'header_text_color' => $request->header_text_color,
            'footer_bg_color' => $request->footer_bg_color,
            'include_photo' => $request->has('include_photo'),
            'include_skills' => $request->has('include_skills'),
            'include_experience' => $request->has('include_experience'),
            'include_education' => $request->has('include_education'),
            'include_projects' => $request->has('include_projects'),
            'include_certifications' => $request->has('include_certifications'),
        ]);

        return redirect()->back()->with('success', 'Resume settings updated successfully!');
    }

    /**
     * Preview resume (beautiful version for screen)
     */
    public function preview()
    {
        $settings = ResumeSetting::instance();
        $about = About::first();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $educations = Education::orderBy('start_date', 'desc')->get();
        $projects = Project::where('is_active', true)->orderBy('created_at', 'desc')->limit(5)->get();
        $certifications = Certification::orderBy('created_at', 'desc')->get();

        // Use preview version with beautiful styles for screen viewing
        return view('front.resume-templates.' . $settings->template . '-preview', compact(
            'settings', 'about', 'skills', 'experiences', 'educations', 'projects', 'certifications'
        ));
    }

    /**
     * Download resume as PDF (mPDF compatible version)
     */
    public function download()
    {
        $settings = ResumeSetting::instance();
        $about = About::first();
        $skills = Skill::where('is_active', true)->orderBy('sort_order')->get();
        $experiences = Experience::orderBy('start_date', 'desc')->get();
        $educations = Education::orderBy('start_date', 'desc')->get();
        $projects = Project::where('is_active', true)->orderBy('created_at', 'desc')->limit(5)->get();
        $certifications = Certification::orderBy('created_at', 'desc')->get();

        // Use standard version (mPDF compatible) for PDF export
        $view = view('front.resume-templates.' . $settings->template, compact(
            'settings', 'about', 'skills', 'experiences', 'educations', 'projects', 'certifications'
        ))->render();

        try {
            $mpdf = new Mpdf([
                'mode' => 'UTF-8',
                'format' => 'A4',
                'orientation' => 'P',
                'margin_left' => 15,
                'margin_right' => 15,
                'margin_top' => 15,
                'margin_bottom' => 15,
            ]);

            $mpdf->WriteHTML($view);

            $filename = 'resume-' . ($about->name ?? 'portfolio') . '-' . date('Y-m-d') . '.pdf';

            return response()->streamDownload(
                fn () => $mpdf->Output($filename, \Mpdf\Output\Destination::STRING_RETURN),
                $filename,
                ['Content-Type' => 'application/pdf']
            );
        } catch (\Exception $e) {
            return response($view, 200, [
                'Content-Type' => 'text/html',
                'Content-Disposition' => 'inline; filename="resume-preview.html"'
            ]);
        }
    }
}

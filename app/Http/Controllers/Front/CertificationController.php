<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\View\View;

class CertificationController extends Controller
{
    public function index(): View
    {
        $certifications = Certification::orderBy('issue_date', 'desc')->get();

        return view('front.certifications.index', compact('certifications'));
    }
}

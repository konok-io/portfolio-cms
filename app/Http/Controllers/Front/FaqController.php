<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class FaqController extends Controller
{
    /**
     * Display FAQ page
     */
    public function index()
    {
        $faqs = Faq::getActive();
        View::share('pageContent', PageContent::getPage('faq'));
        return view('front.faq', compact('faqs'));
    }
}

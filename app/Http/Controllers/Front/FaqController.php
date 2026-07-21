<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display FAQ page
     */
    public function index()
    {
        $faqs = Faq::getActive();
        return view('front.faq', compact('faqs'));
    }
}

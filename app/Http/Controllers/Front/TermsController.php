<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class TermsController extends Controller
{
    public function index()
    {
        $siteSetting = Setting::instance();
        return view('front.terms', compact('siteSetting'));
    }
}

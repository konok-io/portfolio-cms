<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $siteSetting = Setting::instance();
        return view('front.privacy', compact('siteSetting'));
    }
}

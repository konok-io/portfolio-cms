<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PrivacyPolicyController extends Controller
{
    public function index()
    {
        $siteSetting = Setting::instance();
        
        // Create a fake page object to control header/footer visibility
        $page = new CustomPage([
            'show_in_header' => true,
            'show_in_footer' => true,
        ]);
        View::share('page', $page);
        
        return view('front.privacy', compact('siteSetting'));
    }
}

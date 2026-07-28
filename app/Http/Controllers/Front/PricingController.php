<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PageContent;
use App\Models\PricingPlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PricingController extends Controller
{
    /**
     * Display pricing page
     */
    public function index()
    {
        $plans = PricingPlan::getActive();
        View::share('pageContent', PageContent::getPage('pricing'));
        return view('front.pricing', compact('plans'));
    }
}

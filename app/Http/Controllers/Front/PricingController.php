<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display pricing page
     */
    public function index()
    {
        $plans = PricingPlan::getActive();
        return view('front.pricing', compact('plans'));
    }
}

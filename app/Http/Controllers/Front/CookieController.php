<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CookieController extends Controller
{
    public function accept(Request $request)
    {
        session(['cookie_consent' => true, 'cookie_accepted_at' => now()]);
        
        return response()->json(['success' => true]);
    }

    public function decline(Request $request)
    {
        session(['cookie_consent' => false, 'cookie_declined_at' => now()]);
        
        return response()->json(['success' => true]);
    }
}

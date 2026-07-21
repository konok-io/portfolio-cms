<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    /**
     * Display the page
     */
    public function show(CustomPage $page)
    {
        if (!$page->is_published) {
            abort(404);
        }

        return view('front.custom-page', compact('page'));
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

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

        // Get localized content for this custom page
        $pageKey = 'custom_' . $page->id;
        
        // Share page variable with all views/layouts
        View::share('page', $page);
        View::share('customPageContent', PageContent::getPage($pageKey));

        return view('front.custom-page', compact('page'));
    }
}

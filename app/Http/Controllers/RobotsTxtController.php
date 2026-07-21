<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Request;

class RobotsTxtController extends Controller
{
    public function index()
    {
        $seo = SeoSetting::instance();
        
        $content = $seo->getRobotsTxt();
        
        // Check for noindex directive
        $robotsDirectives = $seo->getRobotsDirectives();
        
        $response = response($content, 200, [
            'Content-Type' => 'text/plain; charset=utf-8',
        ]);
        
        return $response;
    }
}

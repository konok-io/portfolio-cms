<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Project;
use App\Models\Service;
use App\Models\CustomPage;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        $isLive = $request->boolean('live');

        if (empty($query)) {
            if ($isLive) {
                return response()->json(['total' => 0, 'projects' => [], 'blogs' => [], 'services' => [], 'pages' => []]);
            }
            return redirect()->back();
        }

        $projects = Project::active()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->limit($isLive ? 3 : 5)
            ->get();

        $blogs = Blog::published()
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('short_description', 'like', "%{$query}%");
            })
            ->limit($isLive ? 3 : 5)
            ->get();

        $services = Service::active()
            ->where(function ($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('description', 'like', "%{$query}%");
            })
            ->limit($isLive ? 3 : 5)
            ->get();

        $pages = CustomPage::where('is_published', true)
            ->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%");
            })
            ->limit($isLive ? 2 : 5)
            ->get();

        // Return JSON for live search
        if ($isLive) {
            return response()->json([
                'total' => $projects->count() + $blogs->count() + $services->count() + $pages->count(),
                'projects' => $projects->map(function($p) {
                    return [
                        'title' => $p->title,
                        'url' => route('projects.show', $p->slug),
                        'category' => $p->category?->name
                    ];
                }),
                'blogs' => $blogs->map(function($b) {
                    return [
                        'title' => $b->title,
                        'url' => route('blog.show', $b->slug),
                        'category' => $b->category?->name
                    ];
                }),
                'services' => $services->map(function($s) {
                    return [
                        'title' => $s->title,
                        'url' => route('services')
                    ];
                }),
                'pages' => $pages->map(function($p) {
                    return [
                        'title' => $p->title,
                        'url' => route('page.show', $p->slug)
                    ];
                })
            ]);
        }

        $totalResults = $projects->count() + $blogs->count() + $services->count() + $pages->count();

        return view('front.search', compact(
            'query',
            'projects',
            'blogs',
            'services',
            'pages',
            'totalResults'
        ));
    }
}

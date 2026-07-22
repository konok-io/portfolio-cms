<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::withCount(['blogs' => function ($query) {
            $query->published();
        }])
        ->having('blogs_count', '>', 0)
        ->orderByDesc('blogs_count')
        ->get();

        return view('front.blog.categories', compact('categories'));
    }

    public function show(BlogCategory $category, Request $request)
    {
        $query = Blog::published()
            ->where('blog_category_id', $category->id)
            ->with(['category', 'author', 'tags'])
            ->latest('published_at');

        // Apply tag filter
        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        $blogs = $query->paginate(6)->withQueryString();

        // Get tags for this category
        $tags = \App\Models\Tag::whereHas('blogs', function ($q) use ($category) {
            $q->where('blog_category_id', $category->id)->published();
        })->withCount(['blogs' => function ($q) use ($category) {
            $q->where('blog_category_id', $category->id)->published();
        }])->orderByDesc('blogs_count')->limit(15)->get();

        return view('front.blog.category', compact('category', 'blogs', 'tags'));
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()->with(['category', 'author'])->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $blogs = $query->paginate(6)->withQueryString();
        $categories = BlogCategory::orderBy('name')->get();

        return view('front.blog.index', compact('blogs', 'categories'));
    }

    public function show(Blog $blog)
    {
        abort_if($blog->status !== 'published', 404);

        $blog->increment('views');
        $blog->load(['category', 'author']);

        $relatedBlogs = Blog::published()
            ->where('id', '!=', $blog->id)
            ->when($blog->blog_category_id, function ($q) use ($blog) {
                $q->where('blog_category_id', $blog->blog_category_id);
            })
            ->take(3)
            ->get();

        return view('front.blog.show', compact('blog', 'relatedBlogs'));
    }
}

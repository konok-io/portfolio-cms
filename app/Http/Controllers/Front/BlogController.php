<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()->with(['category', 'author', 'tags'])->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('tag')) {
            $query->whereHas('tags', function ($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }

        if ($request->filled('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $blogs = $query->paginate(6)->withQueryString();
        $categories = BlogCategory::orderBy('name')->get();
        $tags = Tag::withCount('blogs')->orderBy('blogs_count', 'desc')->limit(20)->get();

        return view('front.blog.index', compact('blogs', 'categories', 'tags'));
    }

    public function show(Blog $blog)
    {
        abort_if($blog->status !== 'published', 404);

        $blog->incrementViewCount();
        $blog->load(['category', 'author', 'allComments', 'allComments.replies']);

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

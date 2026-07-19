<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()->with(['category', 'author'])->latest('published_at');

        if ($request->filled('category')) {
            $query->whereHas('category', fn ($q) => $q->where('slug', $request->category));
        }

        $blogs = $query->paginate((int) $request->get('per_page', 10));

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    public function show(Blog $blog)
    {
        if ($blog->status !== 'published') {
            return response()->json([
                'success' => false,
                'message' => 'Blog post not found.',
            ], 404);
        }

        $blog->load(['category', 'author']);

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }
}

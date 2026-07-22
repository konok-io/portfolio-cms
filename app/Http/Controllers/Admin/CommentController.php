<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        $query = Comment::with('blog')->latest();

        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->where('is_approved', false);
            } elseif ($request->status === 'approved') {
                $query->where('is_approved', true);
            }
        }

        if ($request->filled('blog_id')) {
            $query->where('blog_id', $request->blog_id);
        }

        $comments = $query->paginate(20);
        $blogs = Blog::has('comments')->get();
        $stats = [
            'total' => Comment::count(),
            'pending' => Comment::where('is_approved', false)->count(),
            'approved' => Comment::where('is_approved', true)->count(),
        ];

        return view('admin.comments.index', compact('comments', 'blogs', 'stats'));
    }

    public function approve(Comment $comment)
    {
        $comment->approve();
        return back()->with('success', 'Comment approved.');
    }

    public function reject(Comment $comment)
    {
        $comment->reject();
        return back()->with('success', 'Comment rejected.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    public function store(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'comment' => ['required', 'string', 'min:10'],
            'parent_id' => ['nullable', 'exists:comments,id'],
        ]);

        $validated['blog_id'] = $blog->id;
        $validated['is_approved'] = false; // Require approval

        Comment::create($validated);

        return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
    }
}

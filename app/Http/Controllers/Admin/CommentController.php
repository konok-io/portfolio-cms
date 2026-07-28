<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
        $siteSetting = Setting::instance();
        
        // Honeypot spam protection - reject if field is filled
        if ($request->filled('homepage')) {
            // Bot detected - silently "succeed" but don't save
            return back()->with('success', 'Your comment has been submitted and is awaiting approval.');
        }
        
        // Validate reCAPTCHA if enabled
        if ($siteSetting->isRecaptchaEnabled()) {
            $recaptchaValidation = $this->validateRecaptcha($request->input('g-recaptcha-response'), $siteSetting->recaptcha_secret_key);
            
            if (!$recaptchaValidation['success']) {
                return back()->withErrors(['recaptcha' => 'reCAPTCHA verification failed. Please try again.'])->withInput();
            }
        }

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
    
    protected function validateRecaptcha(string $recaptchaResponse, string $secretKey): array
    {
        try {
            $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
            ]);
            
            $result = $response->json();
            
            return [
                'success' => $result['success'] ?? false,
                'score' => $result['score'] ?? null,
                'error-codes' => $result['error-codes'] ?? [],
            ];
        } catch (\Exception $e) {
            \Log::error('reCAPTCHA validation failed: ' . $e->getMessage());
            return ['success' => false, 'error-codes' => ['network-error']];
        }
    }
}

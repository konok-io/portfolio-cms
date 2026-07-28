<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Get user's comments
        $userComments = Comment::where('email', $user->email)
            ->with('blog')
            ->latest()
            ->paginate(10);
        
        // Get user's liked/saved projects (if you have a likes feature)
        $stats = [
            'comments_count' => Comment::where('email', $user->email)->count(),
            'approved_comments' => Comment::where('email', $user->email)->where('is_approved', true)->count(),
        ];

        return view('front.user.dashboard', compact('user', 'userComments', 'stats'));
    }

    public function profile()
    {
        return view('front.user.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'bio' => ['nullable', 'string', 'max:500'],
            'website' => ['nullable', 'url', 'max:255'],
        ]);

        $user->update($validated);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        auth()->user()->update([
            'password' => bcrypt($validated['password']),
        ]);

        return back()->with('success', 'Password updated successfully.');
    }
}

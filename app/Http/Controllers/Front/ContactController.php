<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\NewContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $siteSetting = Setting::instance();

        return view('front.contact', [
            'siteSetting' => $siteSetting,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:5000'],
        ]);

        $validated['ip_address'] = $request->ip();

        $contactMessage = ContactMessage::create($validated);

        // Send email notification to admin users
        $adminUsers = User::whereHas('roles', function ($query) {
            $query->where('name', 'Admin');
        })->get();

        foreach ($adminUsers as $admin) {
            $admin->notify(new NewContactMessage($contactMessage));
        }

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
        }

        return redirect()->route('thank-you')->with('success', 'Your message has been sent successfully!');
    }
}

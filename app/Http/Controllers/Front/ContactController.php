<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
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

        ContactMessage::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'message' => 'Your message has been sent successfully!']);
        }

        return back()->with('success', 'Your message has been sent successfully! I will get back to you soon.');
    }
}

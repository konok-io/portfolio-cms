<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first() ?? new About;

        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first() ?? new About;

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['nullable', 'string', 'max:255'],
            'short_intro' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'cv_file' => ['nullable', 'file', 'mimes:pdf', 'max:5120'],
            'address' => ['nullable', 'string', 'max:500'],
            'phone' => ['nullable', 'string', 'max:50'],
            'whatsapp' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:500'],
            'github' => ['nullable', 'url', 'max:500'],
            'facebook' => ['nullable', 'url', 'max:500'],
            'twitter' => ['nullable', 'url', 'max:500'],
            'instagram' => ['nullable', 'url', 'max:500'],
            'google_map' => ['nullable', 'url', 'max:500'],
        ]);

        if ($request->hasFile('photo')) {
            if ($about->photo) {
                Storage::disk('public')->delete($about->photo);
            }
            $validated['photo'] = $request->file('photo')->store('about', 'public');
        }

        if ($request->hasFile('cv_file')) {
            if ($about->cv_file) {
                Storage::disk('public')->delete($about->cv_file);
            }
            $validated['cv_file'] = $request->file('cv_file')->store('about', 'public');
        }

        $about->fill($validated)->save();

        return redirect()->route('admin.about.edit')->with('success', 'About information updated successfully.');
    }
}

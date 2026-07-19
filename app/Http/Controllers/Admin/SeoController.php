<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function edit()
    {
        $seo = SeoSetting::instance();

        return view('admin.seo.edit', compact('seo'));
    }

    public function update(Request $request)
    {
        $seo = SeoSetting::instance();

        $validated = $request->validate([
            'meta_title' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords' => ['nullable', 'string', 'max:255'],
            'og_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('og_image')) {
            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        $seo->update($validated);

        return redirect()->route('admin.seo.edit')->with('success', 'SEO settings updated successfully.');
    }
}

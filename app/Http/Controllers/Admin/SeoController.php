<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeoUpdateRequest;
use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoController extends Controller
{
    public function edit()
    {
        $seo = SeoSetting::instance();
        $seoHealth = $seo->seoHealthCheck();

        return view('admin.seo.edit', compact('seo', 'seoHealth'));
    }

    public function update(SeoUpdateRequest $request)
    {
        $seo = SeoSetting::instance();
        $validated = $request->validated();

        // Handle OG Image upload
        if ($request->hasFile('og_image')) {
            if ($seo->og_image) {
                Storage::disk('public')->delete($seo->og_image);
            }
            $validated['og_image'] = $request->file('og_image')->store('seo', 'public');
        } else {
            unset($validated['og_image']);
        }

        // Handle Twitter Image upload
        if ($request->hasFile('twitter_image')) {
            if ($seo->twitter_image) {
                Storage::disk('public')->delete($seo->twitter_image);
            }
            $validated['twitter_image'] = $request->file('twitter_image')->store('seo', 'public');
        } else {
            unset($validated['twitter_image']);
        }

        // Handle Organization Logo upload
        if ($request->hasFile('organization_logo')) {
            if ($seo->organization_logo) {
                Storage::disk('public')->delete($seo->organization_logo);
            }
            $validated['organization_logo'] = $request->file('organization_logo')->store('seo', 'public');
        } else {
            unset($validated['organization_logo']);
        }

        // Sanitize custom code fields
        if (isset($validated['custom_head_code'])) {
            $validated['custom_head_code'] = $this->sanitizeCustomCode($validated['custom_head_code']);
        }
        if (isset($validated['custom_body_code'])) {
            $validated['custom_body_code'] = $this->sanitizeCustomCode($validated['custom_body_code']);
        }
        if (isset($validated['robots_txt_content'])) {
            $validated['robots_txt_content'] = strip_tags($validated['robots_txt_content']);
        }

        $seo->update($validated);

        return redirect()->route('admin.seo.edit')
            ->with('success', 'SEO settings updated successfully.');
    }

    private function sanitizeCustomCode(string $code): string
    {
        // Remove script tags with dangerous content
        $code = preg_replace('/<script[^>]*>(.*?)<\/script>/is', '', $code);
        
        // Remove event handlers (onclick, onerror, etc.)
        $code = preg_replace('/\s+on\w+\s*=\s*["\'][^"\']*["\']/i', '', $code);
        
        // Remove javascript: protocol in hrefs
        $code = preg_replace('/href\s*=\s*["\']javascript:[^"\']*["\']/i', '', $code);
        
        return $code;
    }
}

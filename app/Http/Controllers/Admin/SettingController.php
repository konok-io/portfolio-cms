<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::instance();

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $setting = Setting::instance();

        $validated = $request->validate([
            'site_name' => ['required', 'string', 'max:255'],
            'header_display' => ['nullable', 'in:text,logo,both'],
            'default_language' => ['nullable', 'string', 'max:10'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,svg,webp', 'max:1024'],
            'favicon' => ['nullable', 'image', 'mimes:jpg,jpeg,png,ico,svg', 'max:512'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'google_map' => ['nullable', 'string'],
            'facebook' => ['nullable', 'url', 'max:255'],
            'twitter' => ['nullable', 'url', 'max:255'],
            'linkedin' => ['nullable', 'url', 'max:255'],
            'github' => ['nullable', 'url', 'max:255'],
            'instagram' => ['nullable', 'url', 'max:255'],
            'youtube' => ['nullable', 'url', 'max:255'],
            'maintenance_mode' => ['nullable', 'in:1'],
            'recaptcha_site_key' => ['nullable', 'string', 'max:255'],
            'recaptcha_secret_key' => ['nullable', 'string', 'max:255'],
            'recaptcha_enabled' => ['nullable', 'in:1'],
            'google_analytics_id' => ['nullable', 'string', 'max:50'],
            'google_tag_manager_id' => ['nullable', 'string', 'max:50'],
            'analytics_enabled' => ['nullable', 'in:1'],
            'mail_driver' => ['nullable', 'string', 'max:50'],
            'mail_host' => ['nullable', 'string', 'max:255'],
            'mail_port' => ['nullable', 'string', 'max:10'],
            'mail_username' => ['nullable', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_encryption' => ['nullable', 'string', 'max:10'],
            'mail_from_address' => ['nullable', 'email', 'max:255'],
            'mail_from_name' => ['nullable', 'string', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            if ($setting->logo) {
                Storage::disk('public')->delete($setting->logo);
            }
            $validated['logo'] = $request->file('logo')->store('settings', 'public');
        }

        if ($request->hasFile('favicon')) {
            if ($setting->favicon) {
                Storage::disk('public')->delete($setting->favicon);
            }
            $validated['favicon'] = $request->file('favicon')->store('settings', 'public');
        }

        // Handle maintenance_mode checkbox
        $validated['maintenance_mode'] = $request->has('maintenance_mode') ? 1 : 0;
        
        // Handle recaptcha_enabled checkbox
        $validated['recaptcha_enabled'] = $request->has('recaptcha_enabled') ? 1 : 0;

        // Handle analytics_enabled checkbox
        $validated['analytics_enabled'] = $request->has('analytics_enabled') ? 1 : 0;

        $setting->update($validated);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
    
    public function testMail(Request $request)
    {
        $setting = Setting::instance();
        $setting->applyMailConfig();
        
        try {
            \Illuminate\Support\Facades\Mail::raw('This is a test email from Portfolio CMS.', function ($message) use ($setting, $request) {
                $message->to($request->input('test_email'))
                    ->subject('Portfolio CMS - Test Email');
            });
            
            return response()->json(['success' => true, 'message' => 'Test email sent successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to send test email: ' . $e->getMessage()], 500);
        }
    }
}

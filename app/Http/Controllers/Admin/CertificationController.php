<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    /**
     * Display certifications list
     */
    public function index()
    {
        $certifications = Certification::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.certifications.index', compact('certifications'));
    }

    /**
     * Store new certification
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:500',
            'badge_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('badge_image');
        
        if ($request->hasFile('badge_image')) {
            $data['badge_image'] = $request->file('badge_image')->store('certifications', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        Certification::create($data);

        return redirect()->back()->with('success', 'Certification created successfully!');
    }

    /**
     * Update certification
     */
    public function update(Request $request, Certification $certification)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'issuer' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'expiry_date' => 'nullable|date|after:issue_date',
            'credential_id' => 'nullable|string|max:255',
            'credential_url' => 'nullable|url|max:500',
            'badge_image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except('badge_image');
        
        if ($request->hasFile('badge_image')) {
            // Delete old image
            if ($certification->badge_image) {
                \Storage::disk('public')->delete($certification->badge_image);
            }
            $data['badge_image'] = $request->file('badge_image')->store('certifications', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');

        $certification->update($data);

        return redirect()->back()->with('success', 'Certification updated successfully!');
    }

    /**
     * Delete certification
     */
    public function destroy(Certification $certification)
    {
        if ($certification->badge_image) {
            \Storage::disk('public')->delete($certification->badge_image);
        }
        
        $certification->delete();
        return redirect()->back()->with('success', 'Certification deleted successfully!');
    }
}

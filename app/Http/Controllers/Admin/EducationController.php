<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function index()
    {
        $educations = Education::ordered()->get();

        return view('admin.education.index', compact('educations'));
    }

    public function create()
    {
        return view('admin.education.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        Education::create($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education added successfully.');
    }

    public function edit(Education $education)
    {
        return view('admin.education.edit', compact('education'));
    }

    public function update(Request $request, Education $education)
    {
        $validated = $this->validateData($request);

        $education->update($validated);

        return redirect()->route('admin.education.index')->with('success', 'Education updated successfully.');
    }

    public function destroy(Education $education)
    {
        $education->delete();

        return redirect()->route('admin.education.index')->with('success', 'Education deleted successfully.');
    }

    protected function validateData(Request $request): array
    {
        $validated = $request->validate([
            'institute_name' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'start_year' => ['required', 'digits:4'],
            'end_year' => ['nullable', 'digits:4'],
            'description' => ['nullable', 'string'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        return $validated;
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\Request;

class CustomPageController extends Controller
{
    /**
     * Display pages list
     */
    public function index()
    {
        $pages = CustomPage::orderBy('sort_order')->get();
        return view('admin.custom-pages.index', compact('pages'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.custom-pages.create');
    }

    /**
     * Store new page
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:custom_pages,slug',
            'template' => 'required|in:default,full-width',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'show_in_footer' => 'nullable|boolean',
            'show_in_header' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        CustomPage::create([
            'title' => $request->title,
            'slug' => $request->slug ?: \Illuminate\Support\Str::slug($request->title),
            'template' => $request->template,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_published' => $request->boolean('is_published'),
            'show_in_footer' => $request->boolean('show_in_footer'),
            'show_in_header' => $request->boolean('show_in_header'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.custom-pages.index')->with('success', 'Page created successfully!');
    }

    /**
     * Show edit form
     */
    public function edit(CustomPage $customPage)
    {
        return view('admin.custom-pages.edit', compact('customPage'));
    }

    /**
     * Update page
     */
    public function update(Request $request, CustomPage $customPage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:custom_pages,slug,' . $customPage->id,
            'template' => 'required|in:default,full-width',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'nullable|boolean',
            'show_in_footer' => 'nullable|boolean',
            'show_in_header' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $customPage->update([
            'title' => $request->title,
            'slug' => $request->slug ?: \Illuminate\Support\Str::slug($request->title),
            'template' => $request->template,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'is_published' => $request->boolean('is_published'),
            'show_in_footer' => $request->boolean('show_in_footer'),
            'show_in_header' => $request->boolean('show_in_header'),
            'sort_order' => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.custom-pages.index')->with('success', 'Page updated successfully!');
    }

    /**
     * Delete page
     */
    public function destroy(CustomPage $customPage)
    {
        $customPage->delete();
        return redirect()->route('admin.custom-pages.index')->with('success', 'Page deleted successfully!');
    }
}

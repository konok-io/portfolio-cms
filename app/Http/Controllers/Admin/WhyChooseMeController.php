<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WhyChooseMe;
use Illuminate\Http\Request;

class WhyChooseMeController extends Controller
{
    /**
     * Display why choose me list
     */
    public function index()
    {
        $items = WhyChooseMe::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.why-choose-me.index', compact('items'));
    }

    /**
     * Store new item
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        WhyChooseMe::create([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('success', 'Item created successfully!');
    }

    /**
     * Update item
     */
    public function update(Request $request, WhyChooseMe $whyChooseMe)
    {
        $request->validate([
            'icon' => 'required|string|max:100',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $whyChooseMe->update([
            'icon' => $request->icon,
            'title' => $request->title,
            'description' => $request->description,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('success', 'Item updated successfully!');
    }

    /**
     * Delete item
     */
    public function destroy(WhyChooseMe $whyChooseMe)
    {
        $whyChooseMe->delete();
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }
}

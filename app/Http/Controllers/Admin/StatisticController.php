<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Display statistics list
     */
    public function index()
    {
        $statistics = Statistic::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.statistics.index', compact('statistics'));
    }

    /**
     * Store new statistic
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'prefix' => 'nullable|string|max:50',
            'suffix' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        Statistic::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'value' => $request->value,
            'prefix' => $request->prefix,
            'suffix' => $request->suffix,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('success', 'Statistic created successfully!');
    }

    /**
     * Update statistic
     */
    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'value' => 'required|integer|min:0',
            'prefix' => 'nullable|string|max:50',
            'suffix' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $statistic->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'value' => $request->value,
            'prefix' => $request->prefix,
            'suffix' => $request->suffix,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->back()->with('success', 'Statistic updated successfully!');
    }

    /**
     * Delete statistic
     */
    public function destroy(Statistic $statistic)
    {
        $statistic->delete();
        return redirect()->back()->with('success', 'Statistic deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::orderBy('position')->get();
        
        return view('admin.menu.index', compact('menuItems'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'target' => ['nullable', 'in:_self,_blank'],
            'icon' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        
        $validated['position'] = $validated['position'] ?? MenuItem::max('position') + 1;
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        
        MenuItem::create($validated);
        
        return back()->with('success', 'Menu item created successfully.');
    }
    
    public function update(Request $request, MenuItem $menu)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'url' => ['required', 'string', 'max:255'],
            'target' => ['nullable', 'in:_self,_blank'],
            'icon' => ['nullable', 'string', 'max:100'],
            'position' => ['nullable', 'integer'],
            'is_active' => ['nullable', 'boolean'],
        ]);
        
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        
        $menu->update($validated);
        
        return back()->with('success', 'Menu item updated successfully.');
    }
    
    public function destroy(MenuItem $menu)
    {
        $menu->delete();
        
        return back()->with('success', 'Menu item deleted successfully.');
    }
    
    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $position => $id) {
            MenuItem::where('id', $id)->update(['position' => $position]);
        }
        
        return response()->json(['success' => true]);
    }
}

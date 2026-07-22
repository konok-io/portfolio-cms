<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MenuBuilderController extends Controller
{
    public function index()
    {
        $menuItems = MenuItem::ordered()->get();
        $availableRoutes = $this->getAvailableRoutes();
        return view('admin.menu-builder.index', compact('menuItems', 'availableRoutes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'target' => 'nullable|in:_self,_blank',
        ]);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['order'] = $validated['order'] ?? MenuItem::max('order') + 1;

        MenuItem::create($validated);

        return redirect()->route('admin.menu-builder.index')
            ->with('success', 'Menu item created successfully.');
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'route' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:255',
            'order' => 'nullable|integer|min:0',
            'target' => 'nullable|in:_self,_blank',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $menuItem->update($validated);

        return redirect()->route('admin.menu-builder.index')
            ->with('success', 'Menu item updated successfully.');
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->route('admin.menu-builder.index')
            ->with('success', 'Menu item deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        
        foreach ($order as $index => $id) {
            MenuItem::where('id', $id)->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }

    public function toggle(MenuItem $menuItem)
    {
        $menuItem->update(['is_active' => !$menuItem->is_active]);

        return redirect()->route('admin.menu-builder.index')
            ->with('success', $menuItem->is_active ? 'Menu item enabled.' : 'Menu item disabled.');
    }

    private function getAvailableRoutes(): array
    {
        $routes = Route::getRoutes();
        $availableRoutes = [];

        $excludePrefixes = ['admin', 'sanctum', 'ignition', 'livewire', '_ignition', 'chat', 'broadcasting'];
        $excludeNames = ['login', 'logout', 'register', 'password.request', 'password.reset', 'password.email'];

        foreach ($routes as $route) {
            $name = $route->getName();
            $uri = $route->uri();
            
            if (!$name) continue;
            if (in_array($name, $excludeNames)) continue;
            
            foreach ($excludePrefixes as $prefix) {
                if (str_starts_with($name, $prefix . '.') || str_starts_with($uri, $prefix . '/')) {
                    continue 2;
                }
            }

            $availableRoutes[$name] = $name . ' (' . $uri . ')';
        }

        ksort($availableRoutes);
        return $availableRoutes;
    }
}

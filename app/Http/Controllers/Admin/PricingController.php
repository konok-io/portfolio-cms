<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingPlan;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    /**
     * Display a listing of pricing plans
     */
    public function index()
    {
        $plans = PricingPlan::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.pricing.index', compact('plans'));
    }

    /**
     * Show the form for creating a new pricing plan
     */
    public function create()
    {
        return view('admin.pricing.create');
    }

    /**
     * Store a newly created pricing plan
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'badge' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'monthly_price' => 'required|numeric|min:0',
            'yearly_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'features' => 'nullable|string',
            'is_highlighted' => 'nullable|boolean',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Parse features from textarea (one per line)
        $features = [];
        if ($request->filled('features')) {
            $lines = explode("\n", $request->features);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $features[] = $line;
                }
            }
        }

        PricingPlan::create([
            'name' => $request->name,
            'badge' => $request->badge,
            'description' => $request->description,
            'monthly_price' => $request->monthly_price,
            'yearly_price' => $request->yearly_price,
            'currency' => $request->currency ?? 'USD',
            'features' => json_encode($features),
            'is_highlighted' => $request->boolean('is_highlighted'),
            'button_text' => $request->button_text ?? 'Get Started',
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pricing.index')->with('success', 'Pricing plan created successfully!');
    }

    /**
     * Show the form for editing the pricing plan
     */
    public function edit(PricingPlan $pricing)
    {
        return view('admin.pricing.edit', compact('pricing'));
    }

    /**
     * Update the pricing plan
     */
    public function update(Request $request, PricingPlan $pricing)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'badge' => 'nullable|string|max:50',
            'description' => 'nullable|string',
            'monthly_price' => 'required|numeric|min:0',
            'yearly_price' => 'required|numeric|min:0',
            'currency' => 'required|string|max:10',
            'features' => 'nullable|string',
            'is_highlighted' => 'nullable|boolean',
            'button_text' => 'nullable|string|max:50',
            'button_url' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Parse features from textarea (one per line)
        $features = [];
        if ($request->filled('features')) {
            $lines = explode("\n", $request->features);
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    $features[] = $line;
                }
            }
        }

        $pricing->update([
            'name' => $request->name,
            'badge' => $request->badge,
            'description' => $request->description,
            'monthly_price' => $request->monthly_price,
            'yearly_price' => $request->yearly_price,
            'currency' => $request->currency ?? 'USD',
            'features' => json_encode($features),
            'is_highlighted' => $request->boolean('is_highlighted'),
            'button_text' => $request->button_text ?? 'Get Started',
            'button_url' => $request->button_url,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.pricing.index')->with('success', 'Pricing plan updated successfully!');
    }

    /**
     * Remove the pricing plan
     */
    public function destroy(PricingPlan $pricing)
    {
        $pricing->delete();
        return redirect()->route('admin.pricing.index')->with('success', 'Pricing plan deleted successfully!');
    }
}

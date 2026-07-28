<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientPortal;
use App\Models\User;
use Illuminate\Http\Request;

class ClientPortalController extends Controller
{
    public function index(Request $request)
    {
        $query = ClientPortal::with('user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $portals = $query->paginate(15);

        return view('admin.client-portals.index', compact('portals'));
    }

    public function create()
    {
        $users = User::where('is_active', true)->orderBy('name')->get();
        return view('admin.client-portals.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'project_name' => 'required|string|max:255',
            'status' => 'nullable|in:in_progress,review,completed,on_hold',
            'progress' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $validated['project_token'] = \Illuminate\Support\Str::random(64);

        ClientPortal::create($validated);

        return redirect()->route('admin.client-portals.index')->with('success', 'Client portal created successfully.');
    }

    public function show(ClientPortal $clientPortal)
    {
        return view('admin.client-portals.show', compact('clientPortal'));
    }

    public function edit(ClientPortal $clientPortal)
    {
        $users = User::where('is_active', true)->orderBy('name')->get();
        return view('admin.client-portals.edit', compact('clientPortal', 'users'));
    }

    public function update(Request $request, ClientPortal $clientPortal)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'project_name' => 'required|string|max:255',
            'status' => 'nullable|in:in_progress,review,completed,on_hold',
            'progress' => 'nullable|numeric|min:0|max:100',
            'notes' => 'nullable|string',
            'deadline' => 'nullable|date',
        ]);

        $clientPortal->update($validated);

        return redirect()->route('admin.client-portals.show', $clientPortal)->with('success', 'Client portal updated successfully.');
    }

    public function destroy(ClientPortal $clientPortal)
    {
        $clientPortal->delete();

        return redirect()->route('admin.client-portals.index')->with('success', 'Client portal deleted successfully.');
    }

    public function addFile(Request $request, ClientPortal $clientPortal)
    {
        $validated = $request->validate([
            'file_name' => 'required|string|max:255',
            'file_url' => 'required|url',
        ]);

        $clientPortal->addFile($validated['file_name'], $validated['file_url']);

        return back()->with('success', 'File added successfully.');
    }

    public function generateToken(ClientPortal $clientPortal)
    {
        $clientPortal->update(['project_token' => \Illuminate\Support\Str::random(64)]);

        return back()->with('success', 'New access token generated.');
    }
}

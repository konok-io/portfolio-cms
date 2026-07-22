<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Subscriber;
use App\Models\Contact;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $superAdminEmail = config('app.super_admin_email', 'admin@konok.io');

        $query = User::with('roles')->latest();

        // Only the super admin can see the super admin account in the list.
        if (optional(auth()->user())->email !== $superAdminEmail) {
            $query->where('email', '!=', $superAdminEmail);
        }

        $users = $query->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::orderBy('name')->get();

        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_active' => $request->boolean('is_active', true),
        ]);

        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $user)
    {
        $this->protectSuperAdmin($user);

        $roles = Role::orderBy('name')->get();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Block access to the super admin account for everyone except the super admin.
     */
    private function protectSuperAdmin(User $user): void
    {
        $superAdminEmail = config('app.super_admin_email', 'admin@konok.io');

        if ($user->email === $superAdminEmail && optional(auth()->user())->email !== $superAdminEmail) {
            abort(404);
        }
    }

    public function update(Request $request, User $user)
    {
        $this->protectSuperAdmin($user);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'is_active' => $request->boolean('is_active', true),
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);
        $user->syncRoles([$validated['role']]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $this->protectSuperAdmin($user);

        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        // Delete avatar if exists
        if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Export user data as JSON (GDPR compliance)
     */
    public function exportData(User $user)
    {
        $this->protectSuperAdmin($user);

        $exportData = [
            'export_date' => now()->toIso8601String(),
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar ? asset('storage/' . $user->avatar) : null,
                'bio' => $user->bio,
                'website' => $user->website,
                'is_active' => $user->is_active,
                'email_verified_at' => $user->email_verified_at,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
                'roles' => $user->getRoleNames()->toArray(),
            ],
            'related_data' => [
                'submissions' => Contact::where('email', $user->email)->get()->toArray(),
                'comments' => Comment::where('email', $user->email)->get()->toArray(),
                'newsletter_subscriptions' => Subscriber::where('email', $user->email)->get()->toArray(),
            ],
        ];

        $filename = 'user-data-' . $user->id . '-' . date('Y-m-d') . '.json';

        return response()->streamDownload(
            function () use ($exportData) {
                echo json_encode($exportData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            },
            $filename,
            ['Content-Type' => 'application/json']
        );
    }

    /**
     * Bulk delete users (soft delete capable)
     */
    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'users' => ['required', 'array', 'min:1'],
            'users.*' => ['exists:users,id'],
        ]);

        $superAdminEmail = config('app.super_admin_email', 'admin@konok.io');
        $currentUser = auth()->user();

        $users = User::whereIn('id', $request->users)->get();
        $deleted = 0;

        foreach ($users as $user) {
            // Cannot delete self
            if ($user->id === $currentUser->id) {
                continue;
            }

            // Cannot delete super admin
            if ($user->email === $superAdminEmail && $currentUser->email !== $superAdminEmail) {
                continue;
            }

            // Delete avatar
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $user->delete();
            $deleted++;
        }

        return redirect()->route('admin.users.index')
            ->with('success', $deleted . ' user(s) deleted successfully.');
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        Cache::forget(config('permission.cache.key', 'spatie.permission.cache'));

        $modules = [
            'about', 'skills', 'services', 'experience', 'education',
            'projects', 'blog', 'testimonials', 'messages',
            'settings', 'seo', 'users', 'roles',
        ];

        $permissions = [];

        foreach ($modules as $module) {
            foreach (['view', 'create', 'edit', 'delete'] as $action) {
                $permissions[] = "{$action} {$module}";
            }
        }

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $admin = Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        $admin->syncPermissions(Permission::all());

        $editor = Role::firstOrCreate(['name' => 'Editor', 'guard_name' => 'web']);
        $editorPermissions = Permission::where(function ($query) {
            $query->where('name', 'like', 'view %')
                ->orWhere('name', 'like', 'create %')
                ->orWhere('name', 'like', 'edit %');
        })
            ->where('name', 'not like', '%users')
            ->where('name', 'not like', '%roles')
            ->where('name', 'not like', '%settings')
            ->get();
        $editor->syncPermissions($editorPermissions);
    }
}

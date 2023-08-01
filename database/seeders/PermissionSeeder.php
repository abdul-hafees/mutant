<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('permissions')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $permissions = [
            [
                'name' => 'users.viewAny',
                'display_name' => 'View all users'
            ],
            [
                'name' => 'users.view',
                'display_name' => 'View user'
            ],
            [
                'name' => 'users.create',
                'display_name' => 'Create user'
            ],
            [
                'name' => 'users.update',
                'display_name' => 'Update user'
            ],
            [
                'name' => 'users.delete',
                'display_name' => 'Delete user'
            ],

            [
                'name' => 'roles.viewAny',
                'display_name' => 'View all roles'
            ],
            [
                'name' => 'roles.create',
                'display_name' => 'Create role'
            ],
            [
                'name' => 'roles.update',
                'display_name' => 'Update role'
            ],
            [
                'name' => 'roles.delete',
                'display_name' => 'Delete role'
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        $permissions = collect($permissions)->pluck('name');

        /** @var Role $roleAdmin */
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleAdmin->syncPermissions($permissions);
    }
}

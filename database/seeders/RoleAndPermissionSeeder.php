<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'create-users']);
        Permission::create(['name' => 'edit-users']);
        Permission::create(['name' => 'delete-users']);
        Permission::create(['name' => 'show-users']);


        Permission::create(['name' => 'create-contacts']);
        Permission::create(['name' => 'edit-contacts']);
        Permission::create(['name' => 'delete-contacts']);
        Permission::create(['name' => 'show-contacts']);

        $adminRole = Role::create(['name' => 'Admin']);
        $editorRole = Role::create(['name' => 'Editor']);

        $adminRole->givePermissionTo([
            'create-users',
            'edit-users',
            'delete-users',
            'show-users',
            'create-contacts',
            'edit-contacts',
            'delete-contacts',
            'show-contacts',
        ]);

        $editorRole->givePermissionTo([
            'show-contacts',
            'create-contacts',
            'edit-contacts',
            'delete-contacts',
        ]);
    }
}

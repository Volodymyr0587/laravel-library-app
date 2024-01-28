<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'edit book']);
        Permission::create(['name' => 'delete book']);
        Permission::create(['name' => 'create book']);


        // create roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('edit book');
        $role->givePermissionTo('delete book');
        $role->givePermissionTo('create book');


        // create demo users
        // $user = \App\Models\User::factory()->create([
        //     'name' => 'Example User',
        //     'email' => 'test@example.com',
        // ]);
        // $user->assignRole($role);

    }
}

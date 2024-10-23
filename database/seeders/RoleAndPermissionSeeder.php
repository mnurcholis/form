<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'home']);
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'master']);
        Permission::create(['name' => 'user']);
        Permission::create(['name' => 'role']);
        Permission::create(['name' => 'permission']);
        Permission::create(['name' => 'dashboard-tps']);
        Permission::create(['name' => 'pendaftaran-tps']);
        Permission::create(['name' => 'tps']);
        Permission::create(['name' => 'pendaftaran']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $user = Role::create(['name' => 'user']);
        $user->givePermissionTo('home');

        // or may be done by chaining
        Role::create(['name' => 'admin'])->givePermissionTo(['home', 'dashboard']);

        Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'admin-tps'])->givePermissionTo(['dashboard-tps', 'pendaftaran-tps', 'tps']);
        Role::create(['name' => 'tps'])->givePermissionTo(['dashboard-tps', 'tps']);
    }
}

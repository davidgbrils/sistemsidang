<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'manage sidangs']);
        Permission::create(['name' => 'view sidangs']);
        Permission::create(['name' => 'submit sidangs']);
        Permission::create(['name' => 'grade sidangs']);

        // create roles and assign created permissions

        // Admin can do everything
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        // Dosen (Lecturer)
        $role = Role::create(['name' => 'dosen']);
        $role->givePermissionTo(['view sidangs', 'grade sidangs']);

        // Mahasiswa (Student)
        $role = Role::create(['name' => 'mahasiswa']);
        $role->givePermissionTo(['view sidangs', 'submit sidangs']);
    }
}

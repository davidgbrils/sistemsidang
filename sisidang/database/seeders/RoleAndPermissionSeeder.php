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

        // Create permissions idempotently
        $permissions = [
            'manage sidangs',
            'view sidangs',
            'submit sidangs',
            'grade sidangs',
        ];

        foreach ($permissions as $permissionName) {
            Permission::findOrCreate($permissionName, 'web');
        }

        // Create roles idempotently and keep permissions in sync
        $admin = Role::findOrCreate('admin', 'web');
        $admin->syncPermissions(Permission::all());

        $kaprodi = Role::findOrCreate('kaprodi', 'web');
        $kaprodi->syncPermissions(['manage sidangs', 'view sidangs', 'grade sidangs']);

        $staff = Role::findOrCreate('staff_ften', 'web');
        $staff->syncPermissions(['manage sidangs', 'view sidangs']);

        $dosen = Role::findOrCreate('dosen', 'web');
        $dosen->syncPermissions(['view sidangs', 'grade sidangs']);

        $mahasiswa = Role::findOrCreate('mahasiswa', 'web');
        $mahasiswa->syncPermissions(['view sidangs', 'submit sidangs']);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles idempotently
        foreach (['admin', 'kaprodi', 'dosen', 'mahasiswa', 'staff_ften'] as $roleName) {
            Role::findOrCreate($roleName, 'web');
        }
    }
}

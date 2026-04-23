<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@sisidang.com'],
            [
                'name' => 'Admin SiSidang',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );
        $admin->syncRoles(['admin']);

        // Kaprodi
        $kaprodiUser = User::updateOrCreate(
            ['email' => 'kaprodi@sisidang.com'],
            [
                'name' => 'Kepala Prodi',
                'password' => Hash::make('password'),
                'role' => 'kaprodi',
            ]
        );
        $kaprodiUser->syncRoles(['kaprodi']);
        Dosen::updateOrCreate(
            ['user_id' => $kaprodiUser->id],
            [
                'nip' => '198001012000011001',
                'nama' => 'Kepala Prodi, S.T., M.T.',
                'email' => $kaprodiUser->email,
                'jabatan' => 'Lektor Kepala',
                'prodi' => 'Teknik Informatika',
                'is_active' => true,
            ]
        );

        // Dosen (3)
        for ($i = 1; $i <= 3; $i++) {
            $user = User::updateOrCreate(
                ['email' => "dosen$i@sisidang.com"],
                [
                    'name' => "Dosen $i",
                    'password' => Hash::make('password'),
                    'role' => 'dosen',
                ]
            );
            $user->syncRoles(['dosen']);
            Dosen::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => "19900101202001100$i",
                    'nama' => "Dosen $i, S.Kom., M.Kom.",
                    'email' => $user->email,
                    'jabatan' => 'Asisten Ahli',
                    'prodi' => 'Teknik Informatika',
                    'is_active' => true,
                ]
            );
        }

        // Mahasiswa (5)
        for ($i = 1; $i <= 5; $i++) {
            $user = User::updateOrCreate(
                ['email' => "mhs$i@sisidang.com"],
                [
                    'name' => "Mahasiswa $i",
                    'password' => Hash::make('password'),
                    'role' => 'mahasiswa',
                ]
            );
            $user->syncRoles(['mahasiswa']);
            Mahasiswa::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nim' => "202000$i",
                    'nama' => "Mahasiswa $i",
                    'prodi' => 'Teknik Informatika',
                    'angkatan' => 2020,
                    'status' => 'aktif',
                ]
            );
        }
    }
}

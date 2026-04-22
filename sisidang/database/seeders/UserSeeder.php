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
        $admin = User::create([
            'name' => 'Admin SiSidang',
            'email' => 'admin@sisidang.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        // Kaprodi
        $kaprodiUser = User::create([
            'name' => 'Kepala Prodi',
            'email' => 'kaprodi@sisidang.com',
            'password' => Hash::make('password'),
        ]);
        $kaprodiUser->assignRole('kaprodi');
        Dosen::create([
            'user_id' => $kaprodiUser->id,
            'nip' => '198001012000011001',
            'nama' => 'Kepala Prodi, S.T., M.T.',
            'email' => $kaprodiUser->email,
            'jabatan' => 'Lektor Kepala',
            'prodi' => 'Teknik Informatika',
        ]);

        // Dosen (3)
        for ($i = 1; $i <= 3; $i++) {
            $user = User::create([
                'name' => "Dosen $i",
                'email' => "dosen$i@sisidang.com",
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('dosen');
            Dosen::create([
                'user_id' => $user->id,
                'nip' => "19900101202001100$i",
                'nama' => "Dosen $i, S.Kom., M.Kom.",
                'email' => $user->email,
                'jabatan' => 'Asisten Ahli',
                'prodi' => 'Teknik Informatika',
            ]);
        }

        // Mahasiswa (5)
        for ($i = 1; $i <= 5; $i++) {
            $user = User::create([
                'name' => "Mahasiswa $i",
                'email' => "mhs$i@sisidang.com",
                'password' => Hash::make('password'),
            ]);
            $user->assignRole('mahasiswa');
            Mahasiswa::create([
                'user_id' => $user->id,
                'nim' => "202000$i",
                'nama' => "Mahasiswa $i",
                'prodi' => 'Teknik Informatika',
                'angkatan' => 2020,
                'status' => 'aktif',
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // =========================
        // ADMIN
        // =========================
        User::create([
            'nama'          => 'Ranisya',
            'nis'           => '001', // Admin tetap dikasih NIS unik/dummy
            'jenis_kelamin' => 'Perempuan',
            'email'         => 'admin@gmail.com',
            'no_telepon'       => '081234567890',
            'role'          => 'Admin',
            'kelas'         => 'Staff', // Admin bisa diisi 'Staff' atau '-'
            'password'      => Hash::make('123123123'),
            'aksi'          => true,
        ]);
    }
}
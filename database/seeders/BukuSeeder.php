<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Buku::create([
            'judul' => 'Atomic Habits',
            'penulis' => 'James Clear',
            'kategori' => 'Self Development',
            'stok' => 5,
            'cover' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?w=400',
            'tahun_terbit' => 2018
        ]);

        \App\Models\Buku::create([
            'judul' => 'Cyber Security for Beginner',
            'penulis' => 'Kevin Mitnick',
            'kategori' => 'Teknologi',
            'stok' => 2,
            'cover' => 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400',
            'tahun_terbit' => 2021
        ]);
        
    }
}

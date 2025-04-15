<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Import Hash
use App\Models\User; // Import User model

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus user lama jika ada (opsional, hati-hati di production)
        // User::truncate();

        // Buat user admin default
        User::create([
            'name' => 'Admin Modern Sentra',
            'email' => 'admin@modernsentra.test', // Ganti dengan email Anda
            'password' => Hash::make('password'), // Ganti 'password' dengan password aman Anda
            'email_verified_at' => now(), // Anggap email sudah terverifikasi
        ]);

        // Anda bisa tambahkan user lain jika perlu
        // User::factory()->count(5)->create(); // Contoh jika punya UserFactory
    }
}
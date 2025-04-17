<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('Memulai database seeding...');

        $this->call([
            UserSeeder::class,     // Buat user admin dulu
            SettingSeeder::class,  // Isi setting profil perusahaan
            CategorySeeder::class, // Buat kategori produk
            ProductSeeder::class,  // Buat produk & atributnya (menggunakan Factory)
            // ProductsFromCsvSeeder::class, // Uncomment untuk mengimpor produk dari CSV
            // KeywordCategorySeeder::class, // Uncomment untuk mengkategorikan produk berdasarkan kata kunci
        ]);

        $this->command->info('Database seeding selesai.');
    }
}

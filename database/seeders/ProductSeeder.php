<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Import Product
use App\Models\Category; // Import Category

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan ada kategori sebelum membuat produk
        if (Category::count() == 0) {
            $this->command->warn('Tidak ada Kategori. Jalankan CategorySeeder terlebih dahulu.');
            $this->call(CategorySeeder::class); // Coba jalankan CategorySeeder
             if (Category::count() == 0) { // Cek lagi
                 $this->command->error('Gagal membuat kategori. ProductSeeder dibatalkan.');
                 return;
             }
        }

        // Buat 50 produk dummy (sesuaikan jumlahnya)
        // Factory akan otomatis memanggil configure() -> afterCreating()
        // untuk membuat ProductAttribute terkait.
        Product::factory()->count(50)->create();

        $this->command->info('ProductSeeder selesai dijalankan.');
    }
}
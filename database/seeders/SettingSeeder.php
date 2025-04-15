<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting; // Import Setting model

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan updateOrCreate agar aman dijalankan ulang
        Setting::updateOrCreate(
            ['key' => 'nama_toko'],
            ['value' => 'Modern Sentra']
        );
        Setting::updateOrCreate(
            ['key' => 'visi'],
            ['value' => 'Menjadi toko bahan bangunan terdepan dan terpercaya di Sidoarjo dan sekitarnya.']
        );
        Setting::updateOrCreate(
            ['key' => 'misi'],
            ['value' => 'Menyediakan produk berkualitas dengan harga bersaing. Memberikan pelayanan terbaik kepada pelanggan. Menjadi mitra terpercaya bagi kontraktor dan pemilik rumah.']
        );
        Setting::updateOrCreate(
            ['key' => 'sejarah'],
            ['value' => 'Modern Sentra didirikan pada tahun XXXX dengan semangat untuk memenuhi kebutuhan bahan bangunan masyarakat Sidoarjo... (Isi sejarah singkat)']
        );
        Setting::updateOrCreate(
            ['key' => 'alamat'],
            ['value' => 'Jl. Pahlawan No. 1, Sidoarjo, Jawa Timur, 61212'] // Ganti alamat lengkap
        );
        Setting::updateOrCreate(
            ['key' => 'telepon'],
            ['value' => '031-xxxxxxx / 0812-xxxx-xxxx'] // Ganti nomor telepon
        );
        Setting::updateOrCreate(
            ['key' => 'email_kontak'],
            ['value' => 'info@modernsentra.test'] // Ganti email kontak
        );
        Setting::updateOrCreate(
            ['key' => 'jam_operasional'],
            ['value' => 'Senin - Sabtu: 08:00 - 17:00 WIB. Minggu: Libur']
        );
        Setting::updateOrCreate(
            ['key' => 'lokasi_lat'],
            ['value' => '-7.4478'] // Koordinat Latitude Sidoarjo (Ganti dengan titik persis toko Anda)
        );
        Setting::updateOrCreate(
            ['key' => 'lokasi_lng'],
            ['value' => '112.7183'] // Koordinat Longitude Sidoarjo (Ganti dengan titik persis toko Anda)
        );
        // Tambahkan setting lain jika perlu
    }
}

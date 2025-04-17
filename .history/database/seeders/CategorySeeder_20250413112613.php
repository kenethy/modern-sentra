<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // Import Category model
use Illuminate\Support\Str; // Import Str

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kategori Utama
        $cat1 = Category::create(['name' => 'Semen & Agregat', 'slug' => Str::slug('Semen & Agregat')]);
        $cat2 = Category::create(['name' => 'Besi & Baja Ringan', 'slug' => Str::slug('Besi & Baja Ringan')]);
        $cat3 = Category::create(['name' => 'Cat & Pelapis', 'slug' => Str::slug('Cat & Pelapis')]);
        $cat4 = Category::create(['name' => 'Keramik & Sanitasi', 'slug' => Str::slug('Keramik & Sanitasi')]);
        $cat5 = Category::create(['name' => 'Pipa & Fitting', 'slug' => Str::slug('Pipa & Fitting')]);
        $cat6 = Category::create(['name' => 'Alat Pertukangan', 'slug' => Str::slug('Alat Pertukangan')]);
        $cat7 = Category::create(['name' => 'Material Atap', 'slug' => Str::slug('Material Atap')]);

        // Contoh Subkategori
        Category::create([
            'name' => 'Cat Tembok Interior',
            'slug' => Str::slug('Cat Tembok Interior'),
            'parent_id' => $cat3->id // Jadikan subkategori dari 'Cat & Pelapis'
        ]);
        Category::create([
            'name' => 'Cat Tembok Eksterior',
            'slug' => Str::slug('Cat Tembok Eksterior'),
            'parent_id' => $cat3->id
        ]);
         Category::create([
            'name' => 'Keramik Lantai',
            'slug' => Str::slug('Keramik Lantai'),
            'parent_id' => $cat4->id
        ]);
        Category::create([
            'name' => 'Keramik Dinding',
            'slug' => Str::slug('Keramik Dinding'),
            'parent_id' => $cat4->id
        ]);
    }
}
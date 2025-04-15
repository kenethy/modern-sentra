<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category; // Import Category
use App\Models\Product; // Import Product
use App\Models\ProductAttribute; // Import ProductAttribute
use Illuminate\Support\Str; // Import Str

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productName = 'Produk ' . fake()->words(2, true) . ' ' . fake()->safeColorName(); // Nama produk agak unik
        $categoryIds = Category::pluck('id')->toArray(); // Ambil semua ID kategori

        return [
            'name' => $productName,
            'slug' => Str::slug($productName) . '-' . uniqid(), // Tambahkan uniqid agar slug pasti unik
            'category_id' => fake()->randomElement($categoryIds), // Pilih ID kategori secara acak
            'description' => fake()->paragraphs(3, true), // Deskripsi 3 paragraf
            'specifications' => json_encode([ // Buat spesifikasi JSON dummy
                'Merek' => fake()->randomElement(['ABC', 'XYZ', 'TopBrand', 'Lokal Jaya']),
                'Ukuran' => fake()->randomElement(['50kg', '25kg', '1m x 2m', '4"', '60x60cm', '5 Liter']),
                'Warna' => fake()->safeColorName(),
                'Material' => fake()->randomElement(['Beton', 'Baja', 'Plastik PVC', 'Keramik', 'Kayu']),
            ]),
            'usage_tips' => fake()->sentence(10), // Tips penggunaan
            'is_featured' => fake()->boolean(20), // 20% kemungkinan jadi produk unggulan
        ];
    }

    /**
     * Configure the model factory.
     * Callback ini akan dijalankan SETELAH produk dibuat.
     * Kita gunakan untuk membuat ProductAttribute terkait.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Product $product) {
            // Buat 2-4 atribut filter dummy untuk setiap produk
            $attributes = [
                'Merek' => fake()->randomElement(['ABC', 'XYZ', 'TopBrand', 'Lokal Jaya', 'Premium Grade']),
                'Warna Utama' => fake()->safeColorName(),
                'Ukuran Utama' => fake()->randomElement(['Besar', 'Sedang', 'Kecil', '50kg', '25kg']),
                'Finishing' => fake()->randomElement(['Glossy', 'Matte', 'Standard']),
            ];

            // Ambil 2-4 atribut secara acak untuk produk ini
            $selectedAttributes = array_slice($attributes, 0, rand(2, 4));

            foreach ($selectedAttributes as $name => $value) {
                ProductAttribute::create([
                    'product_id' => $product->id,
                    'attribute_name' => $name,
                    'attribute_value' => $value,
                ]);
            }

            // TODO (Next Step): Seed Media Library Images Here
            // Jika sudah setup Spatie Medialibrary, tambahkan kode di sini
            // untuk attach gambar dummy ke produk $product.
            // Contoh:
            // if (class_exists(\Spatie\MediaLibrary\MediaCollections\Models\Media::class)) {
            //     try {
            //         // Ambil path gambar placeholder (misal dari public/images/placeholders)
            //         $placeholderImagePath = public_path('images/placeholders/product-' . rand(1, 5) . '.jpg');
            //         if (file_exists($placeholderImagePath)) {
            //             $product->addMedia($placeholderImagePath)
            //                     ->preservingOriginal() // Simpan file asli
            //                     ->toMediaCollection('product_images'); // Nama collection di Filament/Model
            //         }
            //     } catch (\Exception $e) {
            //         // Handle error jika gagal attach media
            //         \Log::error("Seeding media failed for product ID {$product->id}: " . $e->getMessage());
            //     }
            // }

        });
    }
}
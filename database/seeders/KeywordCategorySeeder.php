<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class KeywordCategorySeeder extends Seeder
{
    /**
     * Mapping kata kunci ke kategori
     */
    protected $keywordMapping = [
        // Cat & Pelapis
        'CAT' => ['category' => 'Cat & Pelapis', 'subcategories' => [
            'CAT TEMBOK' => 'Cat Tembok',
            'CAT KAYU' => 'Cat Kayu',
            'CAT BESI' => 'Cat Besi',
        ]],
        'KUAS' => ['category' => 'Cat & Pelapis', 'subcategories' => [
            'KUAS' => 'Kuas Cat',
        ]],
        
        // Besi & Logam
        'BESI' => ['category' => 'Besi & Logam', 'subcategories' => [
            'BESI' => 'Besi',
            'BAJA' => 'Baja Ringan',
        ]],
        
        // Perkakas & Alat
        'KUNCI' => ['category' => 'Perkakas & Alat', 'subcategories' => [
            'KUNCI' => 'Kunci',
        ]],
        'OBENG' => ['category' => 'Perkakas & Alat', 'subcategories' => [
            'OBENG' => 'Obeng',
        ]],
        'CETOK' => ['category' => 'Perkakas & Alat', 'subcategories' => [
            'CETOK' => 'Cetok & Kape',
            'KAPE' => 'Cetok & Kape',
        ]],
        'TANGGA' => ['category' => 'Perkakas & Alat', 'subcategories' => [
            'TANGGA' => 'Tangga',
        ]],
        
        // Pipa & Fitting
        'PIPA' => ['category' => 'Pipa & Fitting', 'subcategories' => [
            'PIPA PVC' => 'Pipa PVC',
            'PIPA BESI' => 'Pipa Besi',
        ]],
        'FLEXIBLE' => ['category' => 'Pipa & Fitting', 'subcategories' => [
            'FLEXIBLE' => 'Selang Flexible',
        ]],
        
        // Pintu & Jendela
        'ENGSEL' => ['category' => 'Pintu & Jendela', 'subcategories' => [
            'ENGSEL PINTU' => 'Engsel Pintu',
            'ENGSEL JENDELA' => 'Engsel Jendela',
        ]],
        'PINTU' => ['category' => 'Pintu & Jendela', 'subcategories' => [
            'PINTU' => 'Pintu',
        ]],
        
        // Pengencang
        'PAKU' => ['category' => 'Pengencang', 'subcategories' => [
            'PAKU' => 'Paku',
        ]],
        'SEKRUP' => ['category' => 'Pengencang', 'subcategories' => [
            'SEKRUP' => 'Sekrup',
        ]],
        
        // Listrik & Pencahayaan
        'KABEL' => ['category' => 'Listrik & Pencahayaan', 'subcategories' => [
            'KABEL' => 'Kabel Listrik',
        ]],
        'STOP' => ['category' => 'Listrik & Pencahayaan', 'subcategories' => [
            'STOP' => 'Stop Kontak',
        ]],
        'LAMP' => ['category' => 'Listrik & Pencahayaan', 'subcategories' => [
            'LAMP' => 'Lampu & Bohlam',
            'LAMPU' => 'Lampu & Bohlam',
            'BOHLAM' => 'Lampu & Bohlam',
        ]],
        
        // Perekat & Sealant
        'LEM' => ['category' => 'Perekat & Sealant', 'subcategories' => [
            'LEM' => 'Lem Bangunan',
            'LEM PVC' => 'Lem PVC',
        ]],
        
        // Kayu & Panel
        'TRIPLEK' => ['category' => 'Kayu & Panel', 'subcategories' => [
            'TRIPLEK' => 'Triplek',
        ]],
        'GYPSUM' => ['category' => 'Kayu & Panel', 'subcategories' => [
            'GYPSUM' => 'Gypsum',
        ]],
        
        // Sanitasi
        'WASTAFEL' => ['category' => 'Sanitasi', 'subcategories' => [
            'WASTAFEL' => 'Wastafel',
        ]],
        'SINK' => ['category' => 'Sanitasi', 'subcategories' => [
            'SINK' => 'Sink',
            'BAK CUCI' => 'Bak Cuci',
        ]],
        'KRAN' => ['category' => 'Sanitasi', 'subcategories' => [
            'KRAN' => 'Kran Air',
        ]],
        
        // Lantai & Dinding
        'KERAMIK' => ['category' => 'Lantai & Dinding', 'subcategories' => [
            'KERAMIK LANTAI' => 'Keramik Lantai',
            'KERAMIK DINDING' => 'Keramik Dinding',
        ]],
        'LANTAI' => ['category' => 'Lantai & Dinding', 'subcategories' => [
            'LANTAI' => 'Keramik Lantai',
        ]],
        
        // Material Dasar
        'SEMEN' => ['category' => 'Material Dasar', 'subcategories' => [
            'SEMEN' => 'Semen',
        ]],
        'BATU' => ['category' => 'Material Dasar', 'subcategories' => [
            'BATU BATA' => 'Batu Bata',
            'BATU KORAL' => 'Batu Koral',
            'BATU SPLIT' => 'Batu Split',
        ]],
        'BETON' => ['category' => 'Material Dasar', 'subcategories' => [
            'BETON' => 'Beton',
        ]],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Membuat kategori berdasarkan kata kunci produk...');
        
        // Buat kategori utama
        $categories = [];
        $categoryNames = array_unique(array_column($this->keywordMapping, 'category'));
        
        foreach ($categoryNames as $categoryName) {
            $categories[$categoryName] = $this->createCategory($categoryName, 'Kategori ' . $categoryName);
            $this->command->info("Membuat kategori utama: {$categoryName}");
        }
        
        // Buat subkategori
        $subcategories = [];
        
        foreach ($this->keywordMapping as $keyword => $mapping) {
            $categoryName = $mapping['category'];
            $categoryId = $categories[$categoryName]->id;
            
            foreach ($mapping['subcategories'] as $subKeyword => $subcategoryName) {
                // Cek apakah subkategori sudah dibuat
                if (!isset($subcategories[$subcategoryName])) {
                    $subcategories[$subcategoryName] = $this->createSubcategory(
                        $subcategoryName,
                        'Subkategori ' . $subcategoryName,
                        $categoryId,
                        [$keyword]
                    );
                    $this->command->info("Membuat subkategori: {$subcategoryName} (parent: {$categoryName})");
                }
            }
        }
        
        // Buat kategori Uncategorized jika belum ada
        $uncategorized = Category::firstOrCreate(
            ['slug' => 'uncategorized'],
            [
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'description' => 'Produk yang belum dikategorikan',
            ]
        );
        
        $this->command->info('Berhasil membuat ' . Category::count() . ' kategori!');
        
        // Hubungkan produk dengan kategori berdasarkan kata kunci
        $this->linkProductsToCategories($subcategories);
    }
    
    /**
     * Membuat kategori utama
     */
    private function createCategory($name, $description = null)
    {
        return Category::firstOrCreate(
            ['slug' => Str::slug($name)],
            [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
            ]
        );
    }
    
    /**
     * Membuat subkategori
     */
    private function createSubcategory($name, $description = null, $parentId = null, $keywords = [])
    {
        return Category::firstOrCreate(
            ['slug' => Str::slug($name)],
            [
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => $description,
                'parent_id' => $parentId,
                'specifications' => !empty($keywords) ? json_encode(['keywords' => $keywords]) : null,
            ]
        );
    }
    
    /**
     * Hubungkan produk dengan kategori berdasarkan kata kunci
     */
    private function linkProductsToCategories($subcategories)
    {
        $this->command->info('Menghubungkan produk dengan kategori berdasarkan kata kunci...');
        
        // Dapatkan kategori default
        $defaultCategory = Category::firstOrCreate(
            ['slug' => 'uncategorized'],
            [
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'description' => 'Produk yang belum dikategorikan',
            ]
        );
        
        // Dapatkan semua produk
        $products = Product::all();
        $totalProducts = $products->count();
        $updatedProducts = 0;
        
        $this->command->info("Total produk: {$totalProducts}");
        
        // Mulai transaksi
        DB::beginTransaction();
        
        try {
            foreach ($products as $index => $product) {
                $productName = strtoupper($product->name);
                $categoryId = null;
                
                // Cari kategori yang cocok berdasarkan kata kunci
                foreach ($this->keywordMapping as $keyword => $mapping) {
                    if (strpos($productName, $keyword) !== false) {
                        // Cari subkategori yang lebih spesifik
                        foreach ($mapping['subcategories'] as $subKeyword => $subcategoryName) {
                            if (strpos($productName, $subKeyword) !== false) {
                                $categoryId = $subcategories[$subcategoryName]->id;
                                break 2; // Keluar dari kedua loop jika ditemukan
                            }
                        }
                        
                        // Jika tidak ada subkategori yang cocok, gunakan subkategori pertama
                        if (!$categoryId) {
                            $firstSubcategoryName = reset($mapping['subcategories']);
                            $categoryId = $subcategories[$firstSubcategoryName]->id;
                            break;
                        }
                    }
                }
                
                // Jika tidak ada kategori yang cocok, gunakan kategori default
                if (!$categoryId) {
                    $categoryId = $defaultCategory->id;
                }
                
                // Update kategori produk
                $product->category_id = $categoryId;
                $product->save();
                $updatedProducts++;
                
                // Tampilkan progres setiap 100 produk
                if ($updatedProducts % 100 === 0 || $updatedProducts === $totalProducts) {
                    $progress = round(($updatedProducts / $totalProducts) * 100);
                    $this->command->info("Progres: {$progress}% ({$updatedProducts}/{$totalProducts})");
                }
            }
            
            // Commit transaksi
            DB::commit();
            
            $this->command->info("Berhasil menghubungkan {$updatedProducts} produk dengan kategori!");
            
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            $this->command->error("Gagal menghubungkan produk dengan kategori: " . $e->getMessage());
        }
    }
}

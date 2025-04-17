<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductsFromCsvSeeder extends Seeder
{
    /**
     * List of brands to extract from product names
     */
    protected $brands = [
        'AVIAN', 'VINILEX', 'NIPPON', 'CATYLAC', 'DULUX', 'TOA', 'TAMEX', 'TEKIRO', 'TOTO'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = $this->command->ask('Enter the path to your CSV file', 'products.csv');
        
        if (!file_exists($filePath)) {
            $this->command->error("File not found: {$filePath}");
            return;
        }

        // Ensure all brands exist in the database
        $this->ensureBrandsExist();

        // Get default category
        $defaultCategory = Category::firstOrCreate(
            ['name' => 'Uncategorized'],
            [
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'description' => 'Default category for imported products',
            ]
        );

        // Get brand records for later use
        $brandRecords = Brand::all()->keyBy('name')->toArray();
        
        $this->command->info('Starting import process...');
        $this->command->info('Reading CSV file...');
        
        // Open the CSV file
        $file = fopen($filePath, 'r');
        
        // Skip header row
        fgetcsv($file);
        
        $totalRows = 0;
        $importedRows = 0;
        $skippedRows = 0;
        
        // Start transaction
        DB::beginTransaction();
        
        try {
            // Process each row
            while (($row = fgetcsv($file)) !== false) {
                $totalRows++;
                
                // Check if row has enough columns
                if (count($row) < 11) {
                    $this->command->warn("Row {$totalRows} has invalid format. Skipping.");
                    $skippedRows++;
                    continue;
                }
                
                // Extract data from CSV
                $kodeBarang = $row[1] ?? '';
                $namaBarang = $row[2] ?? '';
                $hargaJual = $row[7] ?? 0;
                $hargaBeli = $row[8] ?? 0;
                $stok = $row[9] ?? 0;
                $maxStok = $row[10] ?? 0;
                $totalPenjualan = $row[11] ?? 0;
                
                // Skip if no product name
                if (empty($namaBarang)) {
                    $this->command->warn("Row {$totalRows} has no product name. Skipping.");
                    $skippedRows++;
                    continue;
                }
                
                // Extract brand from product name
                $brandName = $this->extractBrandFromName($namaBarang);
                $brandId = null;
                
                if ($brandName && isset($brandRecords[$brandName])) {
                    $brandId = $brandRecords[$brandName]['id'];
                }
                
                // Create or update product
                $product = Product::updateOrCreate(
                    ['slug' => Str::slug($kodeBarang)],
                    [
                        'name' => $namaBarang,
                        'slug' => Str::slug($kodeBarang),
                        'category_id' => $defaultCategory->id,
                        'brand_id' => $brandId,
                        'description' => "Kode Barang: {$kodeBarang}",
                        'specifications' => json_encode([
                            'Kode Barang' => $kodeBarang,
                            'Harga Jual' => $hargaJual,
                            'Stok' => $stok,
                            'Max Stok' => $maxStok,
                            'Total Penjualan' => $totalPenjualan
                        ]),
                        'is_featured' => false,
                    ]
                );
                
                $importedRows++;
                
                // Show progress every 100 rows
                if ($importedRows % 100 === 0) {
                    $this->command->info("Processed {$importedRows} products...");
                }
            }
            
            // Commit transaction
            DB::commit();
            
            $this->command->info("Import completed successfully!");
            $this->command->info("Total rows: {$totalRows}");
            $this->command->info("Imported products: {$importedRows}");
            $this->command->info("Skipped rows: {$skippedRows}");
            
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            $this->command->error("Import failed: " . $e->getMessage());
        } finally {
            // Close the file
            fclose($file);
        }
    }
    
    /**
     * Extract brand from product name
     */
    protected function extractBrandFromName($name)
    {
        foreach ($this->brands as $brand) {
            // Check if brand name exists in product name (case insensitive)
            if (stripos($name, $brand) !== false) {
                return $brand;
            }
        }
        
        return null;
    }
    
    /**
     * Ensure all brands exist in the database
     */
    protected function ensureBrandsExist()
    {
        $this->command->info('Ensuring brands exist in database...');
        
        foreach ($this->brands as $brandName) {
            Brand::firstOrCreate(
                ['name' => $brandName],
                [
                    'name' => $brandName,
                    'slug' => Str::slug($brandName),
                    'is_active' => true,
                ]
            );
        }
        
        $this->command->info('Brands checked and created if needed.');
    }
}

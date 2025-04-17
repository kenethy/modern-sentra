<?php

namespace App\Console\Commands;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportProductsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products {file : Path to CSV file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products from CSV file and extract brand from product name';

    /**
     * List of brands to extract from product names
     */
    protected $brands = [
        'AVIAN',
        'VINILEX',
        'NIPPON',
        'CATYLAC',
        'DULUX',
        'TOA',
        'TAMEX',
        'TEKIRO',
        'TOTO'
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');

        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }

        // Ensure all brands exist in the database
        $this->ensureBrandsExist();

        // Get or create default category
        $defaultCategory = $this->getDefaultCategory();

        // Get brand records for later use
        $brandRecords = Brand::all()->keyBy('name')->toArray();

        $this->info('Starting import process...');
        $this->info('Reading CSV file...');

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
                    $this->warn("Row {$totalRows} has invalid format. Skipping.");
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
                    $this->warn("Row {$totalRows} has no product name. Skipping.");
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
                        'category_id' => $defaultCategory->id, // Add default category
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
                    $this->info("Processed {$importedRows} products...");
                }
            }

            // Commit transaction
            DB::commit();

            $this->info("Import completed successfully!");
            $this->info("Total rows: {$totalRows}");
            $this->info("Imported products: {$importedRows}");
            $this->info("Skipped rows: {$skippedRows}");
        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            $this->error("Import failed: " . $e->getMessage());
            return 1;
        } finally {
            // Close the file
            fclose($file);
        }

        return 0;
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
        $this->info('Ensuring brands exist in database...');

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

        $this->info('Brands checked and created if needed.');
    }

    /**
     * Get or create default category
     */
    protected function getDefaultCategory()
    {
        $this->info('Getting default category...');

        // Import Category model
        $category = \App\Models\Category::firstOrCreate(
            ['slug' => 'uncategorized'],
            [
                'name' => 'Uncategorized',
                'slug' => 'uncategorized',
                'description' => 'Default category for imported products',
            ]
        );

        $this->info('Using category: ' . $category->name);

        return $category;
    }
}

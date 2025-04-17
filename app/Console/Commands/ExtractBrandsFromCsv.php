<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ExtractBrandsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'extract:brands {file : Path to CSV file} {--min=3 : Minimum word length to consider as brand} {--output=brands.json : Output JSON file}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Extract potential brands from product names in CSV file';

    /**
     * Known brands to look for
     */
    protected $knownBrands = [
        'AVIAN', 'VINILEX', 'NIPPON', 'CATYLAC', 'DULUX', 'TOA', 'TAMEX', 'TEKIRO', 'TOTO'
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = $this->argument('file');
        $minLength = $this->option('min');
        $outputFile = $this->option('output');
        
        if (!file_exists($filePath)) {
            $this->error("File not found: {$filePath}");
            return 1;
        }
        
        $this->info('Starting brand extraction process...');
        $this->info('Reading CSV file...');
        
        // Open the CSV file
        $file = fopen($filePath, 'r');
        
        // Skip header row
        fgetcsv($file);
        
        $totalRows = 0;
        $potentialBrands = [];
        $knownBrandMatches = [];
        
        // Process each row
        while (($row = fgetcsv($file)) !== false) {
            $totalRows++;
            
            // Check if row has enough columns
            if (count($row) < 3) {
                continue;
            }
            
            $productName = $row[2] ?? '';
            
            if (empty($productName)) {
                continue;
            }
            
            // Check for known brands first
            $foundKnownBrand = false;
            foreach ($this->knownBrands as $brand) {
                if (stripos($productName, $brand) !== false) {
                    $knownBrandMatches[$brand] = ($knownBrandMatches[$brand] ?? 0) + 1;
                    $foundKnownBrand = true;
                }
            }
            
            // If no known brand found, try to extract potential brands
            if (!$foundKnownBrand) {
                // Split product name into words
                $words = preg_split('/[\s,\-\/]+/', $productName);
                
                foreach ($words as $word) {
                    // Only consider words that are all uppercase and meet minimum length
                    if (strlen($word) >= $minLength && strtoupper($word) === $word && ctype_alpha($word)) {
                        $potentialBrands[$word] = ($potentialBrands[$word] ?? 0) + 1;
                    }
                }
            }
            
            // Show progress every 1000 rows
            if ($totalRows % 1000 === 0) {
                $this->info("Processed {$totalRows} products...");
            }
        }
        
        // Close the file
        fclose($file);
        
        // Sort by frequency
        arsort($knownBrandMatches);
        arsort($potentialBrands);
        
        // Prepare results
        $results = [
            'total_products' => $totalRows,
            'known_brands' => $knownBrandMatches,
            'potential_brands' => $potentialBrands,
        ];
        
        // Save to JSON file
        File::put($outputFile, json_encode($results, JSON_PRETTY_PRINT));
        
        $this->info("Brand extraction completed!");
        $this->info("Total products processed: {$totalRows}");
        $this->info("Known brands found: " . count($knownBrandMatches));
        $this->info("Potential new brands found: " . count($potentialBrands));
        $this->info("Results saved to: {$outputFile}");
        
        // Display top known brands
        $this->info("\nTop known brands:");
        $count = 0;
        foreach ($knownBrandMatches as $brand => $frequency) {
            $this->line("- {$brand}: {$frequency} products");
            $count++;
            if ($count >= 10) break;
        }
        
        // Display top potential brands
        $this->info("\nTop potential brands:");
        $count = 0;
        foreach ($potentialBrands as $brand => $frequency) {
            if ($frequency >= 10) { // Only show brands that appear at least 10 times
                $this->line("- {$brand}: {$frequency} products");
                $count++;
                if ($count >= 20) break;
            }
        }
        
        return 0;
    }
}

<?php

// Script untuk mengkategorikan produk berdasarkan kata kunci
// Jalankan dengan: php categorize_products.php

// Pastikan ini dijalankan dari root project Laravel
if (!file_exists('artisan')) {
    die("Error: This script must be run from the Laravel project root directory.\n");
}

// Jalankan perintah Artisan
$command = "php artisan db:seed --class=KeywordCategorySeeder";
echo "Running: {$command}\n";
passthru($command);

<?php

// Script untuk menjalankan import secara manual (untuk testing)
// Jalankan dengan: php import_products.php path/to/your/file.csv

// Pastikan ini dijalankan dari root project Laravel
if (!file_exists('artisan')) {
    die("Error: This script must be run from the Laravel project root directory.\n");
}

// Ambil path file dari argumen command line
if ($argc < 2) {
    die("Usage: php import_products.php path/to/your/file.csv\n");
}

$filePath = $argv[1];

if (!file_exists($filePath)) {
    die("Error: File not found: {$filePath}\n");
}

// Jalankan perintah Artisan
$command = "php artisan import:products \"{$filePath}\"";
echo "Running: {$command}\n";
passthru($command);

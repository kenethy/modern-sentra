<?php

// Script untuk memperbaiki produk yang sudah ada tanpa category_id
// Jalankan dengan: php fix_products_without_category.php

// Pastikan ini dijalankan dari root project Laravel
if (!file_exists('artisan')) {
    die("Error: This script must be run from the Laravel project root directory.\n");
}

// Jalankan perintah Artisan
$command = "php artisan tinker --execute=\"
    // Dapatkan kategori default
    \$defaultCategory = \\App\\Models\\Category::firstOrCreate(
        ['slug' => 'uncategorized'],
        [
            'name' => 'Uncategorized',
            'slug' => 'uncategorized',
            'description' => 'Default category for imported products',
        ]
    );
    
    // Dapatkan semua produk tanpa category_id
    \$products = \\App\\Models\\Product::whereNull('category_id')->get();
    
    echo 'Found ' . \$products->count() . ' products without category_id\\n';
    
    // Update semua produk tanpa category_id
    foreach (\$products as \$product) {
        \$product->category_id = \$defaultCategory->id;
        \$product->save();
        echo 'Updated product: ' . \$product->name . '\\n';
    }
    
    echo 'All products have been updated with default category_id\\n';
\"";

echo "Running: {$command}\n";
passthru($command);

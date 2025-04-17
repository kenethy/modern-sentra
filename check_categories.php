<?php

// Script untuk memeriksa hasil kategorisasi produk
// Jalankan dengan: php check_categories.php

// Pastikan ini dijalankan dari root project Laravel
if (!file_exists('artisan')) {
    die("Error: This script must be run from the Laravel project root directory.\n");
}

// Jalankan perintah Artisan
$command = "php artisan tinker --execute=\"
// Hitung jumlah produk per kategori
\\\$categories = \\App\\Models\\Category::withCount('products')->get();
\\\$totalProducts = \\App\\Models\\Product::count();

echo 'Total produk: ' . \\\$totalProducts . PHP_EOL . PHP_EOL;
echo 'Distribusi produk per kategori utama:' . PHP_EOL;

// Kelompokkan kategori berdasarkan parent_id
\\\$parentCategories = \\\$categories->whereNull('parent_id');
foreach (\\\$parentCategories as \\\$category) {
    \\\$subcategories = \\\$categories->where('parent_id', \\\$category->id);
    \\\$totalInCategory = \\\$subcategories->sum('products_count');
    \\\$percentage = round((\\\$totalInCategory / \\\$totalProducts) * 100, 2);
    echo \\\$category->name . ': ' . \\\$totalInCategory . ' produk (' . \\\$percentage . '%)' . PHP_EOL;
}

echo PHP_EOL . 'Top 10 subkategori dengan produk terbanyak:' . PHP_EOL;
\\\$topSubcategories = \\\$categories->whereNotNull('parent_id')->sortByDesc('products_count')->take(10);
foreach (\\\$topSubcategories as \\\$subcategory) {
    \\\$parent = \\\$categories->firstWhere('id', \\\$subcategory->parent_id);
    \\\$percentage = round((\\\$subcategory->products_count / \\\$totalProducts) * 100, 2);
    echo \\\$subcategory->name . ' (parent: ' . \\\$parent->name . '): ' . \\\$subcategory->products_count . ' produk (' . \\\$percentage . '%)' . PHP_EOL;
}
\"";

echo "Running: {$command}\n";
passthru($command);

<?php

/**
 * Script untuk mengimpor data CSV ke database menggunakan PHP native (tanpa Laravel)
 * 
 * Gunakan script ini jika Anda mengalami masalah dengan script Laravel
 * 
 * Cara penggunaan:
 * 1. Edit konfigurasi database di bawah ini
 * 2. Jalankan: php import_csv_native.php path/to/your/file.csv
 */

// Konfigurasi database
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'modern_sentra',
];

// Daftar merk yang dikenali
$brands = [
    'AVIAN', 'VINILEX', 'NIPPON', 'CATYLAC', 'DULUX', 'TOA', 'TAMEX', 'TEKIRO', 'TOTO'
];

// Ambil path file dari argumen command line
if ($argc < 2) {
    die("Usage: php import_csv_native.php path/to/your/file.csv\n");
}

$filePath = $argv[1];

if (!file_exists($filePath)) {
    die("Error: File not found: {$filePath}\n");
}

// Koneksi ke database
try {
    $pdo = new PDO(
        "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8mb4",
        $dbConfig['username'],
        $dbConfig['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
    echo "Connected to database successfully.\n";
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage() . "\n");
}

// Pastikan semua merk ada di database
ensureBrandsExist($pdo, $brands);

// Dapatkan data merk dari database
$brandRecords = getBrands($pdo);

// Dapatkan kategori default
$defaultCategoryId = getDefaultCategory($pdo);

// Mulai impor
echo "Starting import process...\n";
echo "Reading CSV file...\n";

// Buka file CSV
$file = fopen($filePath, 'r');

// Lewati baris header
fgetcsv($file);

$totalRows = 0;
$importedRows = 0;
$skippedRows = 0;

// Mulai transaksi
$pdo->beginTransaction();

try {
    // Proses setiap baris
    while (($row = fgetcsv($file)) !== false) {
        $totalRows++;
        
        // Periksa apakah baris memiliki cukup kolom
        if (count($row) < 11) {
            echo "Warning: Row {$totalRows} has invalid format. Skipping.\n";
            $skippedRows++;
            continue;
        }
        
        // Ekstrak data dari CSV
        $kodeBarang = $row[1] ?? '';
        $namaBarang = $row[2] ?? '';
        $hargaJual = $row[7] ?? 0;
        $hargaBeli = $row[8] ?? 0;
        $stok = $row[9] ?? 0;
        $maxStok = $row[10] ?? 0;
        $totalPenjualan = $row[11] ?? 0;
        
        // Lewati jika tidak ada nama produk
        if (empty($namaBarang)) {
            echo "Warning: Row {$totalRows} has no product name. Skipping.\n";
            $skippedRows++;
            continue;
        }
        
        // Ekstrak merk dari nama produk
        $brandName = extractBrandFromName($namaBarang, $brands);
        $brandId = null;
        
        if ($brandName && isset($brandRecords[$brandName])) {
            $brandId = $brandRecords[$brandName]['id'];
        }
        
        // Buat slug dari kode barang
        $slug = createSlug($kodeBarang);
        
        // Buat atau perbarui produk
        $productId = createOrUpdateProduct($pdo, [
            'name' => $namaBarang,
            'slug' => $slug,
            'category_id' => $defaultCategoryId,
            'brand_id' => $brandId,
            'description' => "Kode Barang: {$kodeBarang}",
            'specifications' => json_encode([
                'Kode Barang' => $kodeBarang,
                'Harga Jual' => $hargaJual,
                'Stok' => $stok,
                'Max Stok' => $maxStok,
                'Total Penjualan' => $totalPenjualan
            ]),
            'is_featured' => 0,
        ]);
        
        $importedRows++;
        
        // Tampilkan progres setiap 100 baris
        if ($importedRows % 100 === 0) {
            echo "Processed {$importedRows} products...\n";
        }
    }
    
    // Commit transaksi
    $pdo->commit();
    
    echo "Import completed successfully!\n";
    echo "Total rows: {$totalRows}\n";
    echo "Imported products: {$importedRows}\n";
    echo "Skipped rows: {$skippedRows}\n";
    
} catch (Exception $e) {
    // Rollback transaksi jika terjadi kesalahan
    $pdo->rollBack();
    echo "Import failed: " . $e->getMessage() . "\n";
} finally {
    // Tutup file
    fclose($file);
}

/**
 * Ekstrak merk dari nama produk
 */
function extractBrandFromName($name, $brands) {
    foreach ($brands as $brand) {
        // Periksa apakah nama merk ada dalam nama produk (case insensitive)
        if (stripos($name, $brand) !== false) {
            return $brand;
        }
    }
    
    return null;
}

/**
 * Pastikan semua merk ada di database
 */
function ensureBrandsExist($pdo, $brands) {
    echo "Ensuring brands exist in database...\n";
    
    foreach ($brands as $brandName) {
        $stmt = $pdo->prepare("SELECT id FROM brands WHERE name = ?");
        $stmt->execute([$brandName]);
        $brand = $stmt->fetch();
        
        if (!$brand) {
            $slug = createSlug($brandName);
            $stmt = $pdo->prepare("INSERT INTO brands (name, slug, is_active, created_at, updated_at) VALUES (?, ?, 1, NOW(), NOW())");
            $stmt->execute([$brandName, $slug]);
            echo "Created brand: {$brandName}\n";
        }
    }
    
    echo "Brands checked and created if needed.\n";
}

/**
 * Dapatkan data merk dari database
 */
function getBrands($pdo) {
    $stmt = $pdo->query("SELECT id, name FROM brands");
    $brands = [];
    
    while ($row = $stmt->fetch()) {
        $brands[$row['name']] = $row;
    }
    
    return $brands;
}

/**
 * Dapatkan kategori default
 */
function getDefaultCategory($pdo) {
    $stmt = $pdo->prepare("SELECT id FROM categories WHERE slug = 'uncategorized'");
    $stmt->execute();
    $category = $stmt->fetch();
    
    if (!$category) {
        $stmt = $pdo->prepare("INSERT INTO categories (name, slug, description, created_at, updated_at) VALUES ('Uncategorized', 'uncategorized', 'Default category for imported products', NOW(), NOW())");
        $stmt->execute();
        return $pdo->lastInsertId();
    }
    
    return $category['id'];
}

/**
 * Buat atau perbarui produk
 */
function createOrUpdateProduct($pdo, $data) {
    // Periksa apakah produk sudah ada
    $stmt = $pdo->prepare("SELECT id FROM products WHERE slug = ?");
    $stmt->execute([$data['slug']]);
    $product = $stmt->fetch();
    
    if ($product) {
        // Perbarui produk yang sudah ada
        $stmt = $pdo->prepare("
            UPDATE products SET 
                name = ?,
                category_id = ?,
                brand_id = ?,
                description = ?,
                specifications = ?,
                is_featured = ?,
                updated_at = NOW()
            WHERE id = ?
        ");
        
        $stmt->execute([
            $data['name'],
            $data['category_id'],
            $data['brand_id'],
            $data['description'],
            $data['specifications'],
            $data['is_featured'],
            $product['id']
        ]);
        
        return $product['id'];
    } else {
        // Buat produk baru
        $stmt = $pdo->prepare("
            INSERT INTO products (
                name, 
                slug, 
                category_id, 
                brand_id, 
                description, 
                specifications, 
                is_featured, 
                created_at, 
                updated_at
            ) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
        ");
        
        $stmt->execute([
            $data['name'],
            $data['slug'],
            $data['category_id'],
            $data['brand_id'],
            $data['description'],
            $data['specifications'],
            $data['is_featured']
        ]);
        
        return $pdo->lastInsertId();
    }
}

/**
 * Buat slug dari string
 */
function createSlug($string) {
    // Ubah ke lowercase
    $string = strtolower($string);
    
    // Hapus karakter khusus
    $string = preg_replace('/[^a-z0-9\s-]/', '', $string);
    
    // Ganti spasi dengan dash
    $string = preg_replace('/[\s-]+/', '-', $string);
    
    // Trim dash di awal dan akhir
    $string = trim($string, '-');
    
    return $string;
}

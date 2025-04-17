# Panduan Impor Data Produk dari CSV

Panduan ini menjelaskan cara mengimpor data produk dari file CSV ke dalam database Modern Sentra, dengan fitur ekstraksi merk dari nama produk.

## Format CSV yang Didukung

Format CSV yang didukung memiliki kolom sebagai berikut:
```
,"Kode Barang","Nama Barang","Merk","No Org","No Prod","Mobil","Harga Jual","Harga Beli","Stok","max stok","Total Penjualan"
```

Contoh baris data:
```
,"00000001","7766TUTU","","","","","9000","0","0","","200"
```

## Daftar Merk yang Dikenali

Script impor akan mengekstrak merk dari nama produk berdasarkan daftar merk berikut:
```
'AVIAN', 'VINILEX', 'NIPPON', 'CATYLAC', 'DULUX', 'TOA', 'TAMEX', 'TEKIRO', 'TOTO'
```

Jika Anda ingin menambahkan atau mengubah daftar merk, Anda dapat mengedit file-file berikut:
- `app/Console/Commands/ImportProductsFromCsv.php`
- `app/Console/Commands/ExtractBrandsFromCsv.php`
- `database/seeders/ProductsFromCsvSeeder.php`

## Cara Menggunakan

### 1. Analisis File CSV (Opsional)

Untuk menganalisis file CSV dan menemukan merk potensial:

```bash
php analyze_csv.php path/to/your/file.csv
```

Hasil analisis akan disimpan dalam file `brands_analysis.json` yang berisi:
- Daftar merk yang dikenali dan jumlah produk untuk setiap merk
- Daftar merk potensial yang diekstrak dari nama produk

### 2. Impor Data Produk

Ada dua cara untuk mengimpor data produk:

#### Menggunakan Artisan Command

```bash
php artisan import:products path/to/your/file.csv
```

#### Menggunakan Script Helper

```bash
php import_products.php path/to/your/file.csv
```

#### Menggunakan Database Seeder

```bash
php artisan db:seed --class=ProductsFromCsvSeeder
```

Seeder akan meminta Anda memasukkan path ke file CSV.

## Proses Impor

Selama proses impor:

1. Script akan memastikan semua merk yang dikenali ada di database
2. Untuk setiap baris dalam file CSV:
   - Data produk akan diekstrak
   - Merk akan diekstrak dari nama produk berdasarkan daftar merk yang dikenali
   - Produk akan dibuat atau diperbarui di database
   - Jika merk ditemukan, produk akan dikaitkan dengan merk tersebut

## Catatan Penting

- Pastikan file CSV Anda menggunakan format yang benar
- Pastikan database Anda sudah diatur dengan benar
- Proses impor menggunakan transaksi database, sehingga jika terjadi kesalahan, tidak ada perubahan yang akan disimpan
- Untuk file CSV yang besar, proses impor mungkin memerlukan waktu yang lama

## Troubleshooting

Jika Anda mengalami masalah selama proses impor:

1. Pastikan format file CSV Anda sesuai dengan yang diharapkan
2. Periksa log Laravel di `storage/logs/laravel.log` untuk informasi kesalahan
3. Coba analisis file CSV terlebih dahulu untuk memastikan data dapat dibaca dengan benar
4. Jika impor gagal, coba impor dengan jumlah data yang lebih kecil untuk mengidentifikasi masalah

### Mengatasi Error "Field 'category_id' doesn't have a default value"

Jika Anda mendapatkan error seperti ini:
```
Import failed: SQLSTATE[HY000]: General error: 1364 Field 'category_id' doesn't have a default value
```

Ini terjadi karena kolom `category_id` di tabel `products` tidak boleh null dan tidak memiliki nilai default. Script impor sudah diperbarui untuk mengatasi masalah ini dengan membuat kategori default "Uncategorized" dan menggunakannya untuk semua produk yang diimpor.

Jika Anda masih mengalami masalah, atau jika Anda sudah memiliki produk tanpa category_id di database, Anda dapat menjalankan script perbaikan:

```bash
php fix_products_without_category.php
```

Script ini akan mencari semua produk tanpa category_id dan mengaturnya ke kategori default "Uncategorized".

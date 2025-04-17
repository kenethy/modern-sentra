# Panduan Kategorisasi Produk Berdasarkan Kata Kunci

Panduan ini menjelaskan cara mengkategorikan produk berdasarkan kata kunci yang terdapat dalam nama produk.

## Daftar Kata Kunci dan Kategori

Berikut adalah daftar kata kunci yang digunakan untuk mengkategorikan produk:

### Cat & Pelapis
- CAT: Cat Tembok / Cat Kayu / Cat Besi
- KUAS: Kuas Cat

### Besi & Logam
- BESI: Besi
- BAJA: Baja Ringan

### Perkakas & Alat
- KUNCI: Kunci (Perkakas)
- OBENG: Obeng
- CETOK/KAPE: Cetok & Kape
- TANGGA: Tangga

### Pipa & Fitting
- PIPA: Pipa PVC / Pipa Besi
- FLEXIBLE: Selang Flexible / Pipa Flexible

### Pintu & Jendela
- ENGSEL: Engsel Pintu / Engsel Jendela
- PINTU: Pintu

### Pengencang
- PAKU: Paku
- SEKRUP: Sekrup

### Listrik & Pencahayaan
- KABEL: Kabel Listrik
- STOP: Stop Kontak
- LAMP/LAMPU/BOHLAM: Lampu & Bohlam

### Perekat & Sealant
- LEM: Lem Bangunan / Lem PVC

### Kayu & Panel
- TRIPLEK: Triplek
- GYPSUM: Gypsum

### Sanitasi
- WASTAFEL: Wastafel
- SINK/BAK CUCI: Sink / Bak Cuci
- KRAN: Kran Air

### Lantai & Dinding
- KERAMIK: Keramik Lantai / Keramik Dinding
- LANTAI: Keramik Lantai

### Material Dasar
- SEMEN: Semen
- BATU: Batu Bata / Batu Koral / Batu Split
- BETON: Beton / Ready Mix

## Cara Menggunakan

### 1. Jalankan Seeder untuk Mengkategorikan Produk

```bash
php categorize_products.php
```

atau

```bash
php artisan db:seed --class=KeywordCategorySeeder
```

### 2. Proses Kategorisasi

Selama proses kategorisasi:

1. Script akan membuat kategori utama dan subkategori berdasarkan daftar kata kunci
2. Script akan menganalisis nama setiap produk dan mencari kata kunci yang cocok
3. Jika ditemukan kata kunci yang cocok, produk akan dikategorikan ke subkategori yang sesuai
4. Jika tidak ditemukan kata kunci yang cocok, produk akan dikategorikan ke kategori "Uncategorized"

### 3. Hasil Kategorisasi

Setelah proses selesai, Anda akan melihat:

- Jumlah kategori yang dibuat
- Jumlah produk yang berhasil dikategorikan
- Progres kategorisasi dalam persentase

## Catatan Penting

- Proses kategorisasi menggunakan transaksi database, sehingga jika terjadi kesalahan, tidak ada perubahan yang akan disimpan
- Jika produk sudah memiliki kategori, kategori tersebut akan diperbarui berdasarkan kata kunci dalam nama produk
- Untuk produk yang tidak memiliki kata kunci yang cocok, kategori akan diatur ke "Uncategorized"
- Jika Anda ingin menambahkan atau mengubah kata kunci, Anda dapat mengedit file `database/seeders/KeywordCategorySeeder.php`

## Troubleshooting

Jika Anda mengalami masalah selama proses kategorisasi:

1. Pastikan semua produk sudah diimpor ke database
2. Periksa log Laravel di `storage/logs/laravel.log` untuk informasi kesalahan
3. Jika kategorisasi gagal, coba jalankan kembali dengan jumlah produk yang lebih kecil untuk mengidentifikasi masalah

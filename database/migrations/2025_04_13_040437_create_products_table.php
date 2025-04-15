<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama produk
            $table->string('slug')->unique(); // URL produk

            // Relasi ke Kategori
            $table->foreignId('category_id')
                  ->constrained('categories') // Foreign key ke tabel categories
                  ->onDelete('cascade'); // Jika kategori dihapus, produk terkait ikut terhapus

            $table->longText('description')->nullable(); // Deskripsi lengkap produk
            
            // Spesifikasi bisa disimpan sebagai JSON agar fleksibel
            $table->json('specifications')->nullable(); 
            // Contoh: {"Merek": "ABC", "Ukuran": "50kg", "Warna": "Putih"}

            $table->text('usage_tips')->nullable(); // Tips penggunaan (opsional)
            $table->boolean('is_featured')->default(false); // Untuk menandai produk unggulan/promo
            
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary key auto-increment (bigint unsigned)
            $table->string('name'); // Nama kategori
            $table->string('slug')->unique(); // Untuk URL yang SEO-friendly, harus unik
            
            // Untuk struktur subkategori (opsional)
            $table->foreignId('parent_id')
                  ->nullable() // Kategori utama tidak punya parent
                  ->constrained('categories') // Foreign key ke tabel ini sendiri
                  ->onDelete('set null'); // Jika parent dihapus, jadikan subkategori sbg kategori utama

            $table->text('description')->nullable(); // Deskripsi singkat kategori
            $table->timestamps(); // Otomatis membuat created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
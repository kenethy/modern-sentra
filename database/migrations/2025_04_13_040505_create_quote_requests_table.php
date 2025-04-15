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
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama pengirim
            $table->string('email');
            $table->string('phone');
            $table->string('company_name')->nullable(); // Nama perusahaan (opsional)
            $table->text('message'); // Pesan permintaan

            // Relasi ke Produk (jika penawaran spesifik utk 1 produk)
            $table->foreignId('product_id')
                  ->nullable() // Bisa jadi permintaan umum, tidak terkait produk spesifik
                  ->constrained('products') // Foreign key ke tabel products
                  ->onDelete('set null'); // Jika produk dihapus, jangan hapus permintaan ini

            $table->string('status')->default('Baru'); // Status permintaan (misal: 'Baru', 'Diproses', 'Selesai')
            $table->timestamps(); // Waktu permintaan dibuat/diupdate
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique(); // Kunci unik (misal: 'visi', 'misi', 'alamat', 'telepon', 'email_kontak', 'jam_operasional', 'lokasi_lat', 'lokasi_lng', 'sejarah')
            $table->longText('value')->nullable(); // Nilai dari setting tersebut
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
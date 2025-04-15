<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'parent_id', // Pastikan ini bisa diisi jika Anda ingin set parent saat create/update
        'description',
    ];

    /**
     * Mendapatkan parent category (jika ada).
     */
    public function parent(): BelongsTo
    {
        // Relasi ke model ini sendiri, foreign key 'parent_id'
        return $this->belongsTo(Category::class, 'parent_id');
    }

    /**
     * Mendapatkan children categories (subkategori langsung).
     */
    public function children(): HasMany
    {
        // Relasi ke model ini sendiri, foreign key 'parent_id'
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * Mendapatkan semua produk dalam kategori ini.
     */
    public function products(): HasMany
    {
        // Satu kategori memiliki banyak produk
        return $this->hasMany(Product::class);
    }

    // Jika Anda menggunakan package seperti spatie/laravel-sluggable
    // Anda akan menambahkan konfigurasi sluggable di sini.
}
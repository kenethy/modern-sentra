<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductAttribute extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id', // Perlu agar bisa dibuat relasinya saat create
        'attribute_name',
        'attribute_value',
    ];

    /**
     * Atribut ini milik produk mana.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    // Tidak perlu timestamps jika Anda tidak menambahkannya di migrasi
    // public $timestamps = false; // uncomment jika tidak ada timestamps
}
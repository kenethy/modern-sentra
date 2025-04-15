<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'description',
        'specifications', // Bisa diisi langsung jika pakai $casts
        'usage_tips',
        'is_featured',
    ];

    /**
     * The attributes that should be cast.
     * Casting 'specifications' ke array agar mudah diolah.
     * Casting 'is_featured' ke boolean.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'specifications' => 'array', // Otomatis encode/decode JSON
        'is_featured' => 'boolean',
    ];

    /**
     * Mendapatkan kategori dari produk ini.
     */
    public function category(): BelongsTo
    {
        // Satu produk milik satu kategori
        return $this->belongsTo(Category::class);
    }

    /**
     * Mendapatkan semua atribut dari produk ini.
     */
    public function attributes(): HasMany
    {
        // Satu produk punya banyak atribut
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * Mendapatkan semua permintaan penawaran untuk produk ini.
     */
    public function quoteRequests(): HasMany
    {
        // Satu produk bisa memiliki banyak permintaan penawaran
        return $this->hasMany(QuoteRequest::class);
    }

    /**
     * Register media collections for this model
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images');
    }
}

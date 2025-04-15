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
     * Mendapatkan semua permintaan penawaran untuk produk ini (untuk backward compatibility).
     */
    public function quoteRequests(): HasMany
    {
        // Satu produk bisa memiliki banyak permintaan penawaran (model lama)
        return $this->hasMany(QuoteRequest::class);
    }

    /**
     * Mendapatkan semua permintaan penawaran yang terkait dengan produk ini.
     */
    public function quoteRequestsMany(): BelongsToMany
    {
        // Relasi many-to-many dengan pivot table yang menyimpan quantity
        return $this->belongsToMany(QuoteRequest::class, 'quote_request_product')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Register media collections for this model
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_images');
    }

    /**
     * Get the brand of the product from specifications
     *
     * @return string|null
     */
    public function getBrandAttribute(): ?string
    {
        if (!$this->specifications) {
            return null;
        }

        // Check for 'Merek', 'Brand', or 'Merk' keys in specifications
        $brandKeys = ['Merek', 'Brand', 'Merk'];

        foreach ($brandKeys as $key) {
            if (isset($this->specifications[$key])) {
                return $this->specifications[$key];
            }
        }

        return null;
    }

    /**
     * Get all unique brands from products
     *
     * @return array
     */
    public static function getAllBrands(): array
    {
        $brands = [];
        $products = self::all();

        foreach ($products as $product) {
            $brand = $product->brand;
            if ($brand && !in_array($brand, $brands)) {
                $brands[] = $brand;
            }
        }

        sort($brands);
        return $brands;
    }
}

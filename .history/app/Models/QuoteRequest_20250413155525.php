<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuoteRequest extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_name',
        'message',
        'product_id', // Agar bisa diisi saat request terkait produk spesifik
        'status',
    ];

    /**
     * Mendapatkan produk yang terkait dengan permintaan ini (jika ada).
     */
    public function product(): BelongsTo
    {
        // Satu permintaan bisa terkait dengan satu produk (atau null)
        return $this->belongsTo(Product::class);
    }
}

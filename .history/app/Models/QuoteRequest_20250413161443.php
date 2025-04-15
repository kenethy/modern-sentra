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
        'response_status',
        'response_message',
        'rejection_reason',
        'quoted_price',
        'response_method',
        'responded_at',
        'admin_notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'responded_at' => 'datetime',
        'quoted_price' => 'decimal:2',
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

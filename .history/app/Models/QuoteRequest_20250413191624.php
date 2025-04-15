<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    /**
     * Mendapatkan URL WhatsApp dengan pesan yang sudah diformat
     */
    public function getWhatsAppUrl(): string
    {
        $phone = preg_replace('/[^0-9]/', '', $this->phone);

        // Jika nomor dimulai dengan 0, ganti dengan 62 (kode negara Indonesia)
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = $this->getFormattedResponseMessage();

        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }

    /**
     * Mendapatkan pesan respons yang terformat
     */
    public function getFormattedResponseMessage(): string
    {
        $productName = $this->product ? $this->product->name : 'produk yang Anda minta';
        $companyName = config('app.name', 'Modern Sentra');

        $message = "Halo {$this->name},\n\n";

        switch ($this->response_status) {
            case 'accepted':
                $message .= "Terima kasih atas permintaan penawaran Anda untuk {$productName}.\n\n";
                $message .= "Kami dengan senang hati memberitahukan bahwa permintaan Anda telah DISETUJUI.\n";

                if ($this->quoted_price) {
                    $message .= "Harga penawaran: Rp " . number_format($this->quoted_price, 0, ',', '.') . "\n";
                }

                if ($this->response_message) {
                    $message .= "\n{$this->response_message}\n";
                }

                $message .= "\nSilakan hubungi kami untuk informasi lebih lanjut atau konfirmasi pemesanan.";
                break;

            case 'rejected':
                $message .= "Terima kasih atas permintaan penawaran Anda untuk {$productName}.\n\n";
                $message .= "Dengan berat hati kami informasikan bahwa kami tidak dapat memenuhi permintaan Anda saat ini.\n";

                if ($this->rejection_reason) {
                    $message .= "\nAlasan: {$this->rejection_reason}\n";
                }

                if ($this->response_message) {
                    $message .= "\n{$this->response_message}\n";
                }

                $message .= "\nKami tetap berharap dapat melayani Anda di kesempatan lain.";
                break;

            case 'negotiation':
                $message .= "Terima kasih atas permintaan penawaran Anda untuk {$productName}.\n\n";
                $message .= "Kami ingin mendiskusikan lebih lanjut mengenai permintaan Anda.\n";

                if ($this->quoted_price) {
                    $message .= "Harga penawaran awal: Rp " . number_format($this->quoted_price, 0, ',', '.') . "\n";
                }

                if ($this->response_message) {
                    $message .= "\n{$this->response_message}\n";
                }

                $message .= "\nMohon hubungi kami untuk negosiasi lebih lanjut.";
                break;

            default:
                $message .= "Terima kasih atas permintaan penawaran Anda untuk {$productName}.\n\n";
                $message .= "Tim kami sedang memproses permintaan Anda dan akan segera menghubungi Anda.\n";

                if ($this->response_message) {
                    $message .= "\n{$this->response_message}\n";
                }
                break;
        }

        $message .= "\n\nSalam,\nTim {$companyName}";

        return $message;
    }
}

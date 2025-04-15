<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'key', // Kunci setting (misal: 'visi')
        'value', // Nilai setting
    ];

    /**
     * The primary key associated with the table.
     * Jika Anda ingin menggunakan 'key' sebagai primary key (alternatif).
     * Tapi biasanya ID auto-increment lebih standar.
     *
     * @var string
     */
    // protected $primaryKey = 'key';

    /**
     * Indicates if the model's ID is auto-incrementing.
     * Set false jika primary key bukan integer auto-increment (misal: jika pakai 'key').
     *
     * @var bool
     */
    // public $incrementing = false;

    /**
      * The data type of the auto-incrementing ID.
      * Set null jika primary key bukan integer.
      *
      * @var string
      */
    // protected $keyType = 'string';

    /**
     * Helper static function untuk mengambil value setting berdasarkan key.
     * Contoh penggunaan: Setting::getValue('visi')
     */
    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    /**
     * Helper static function untuk menyimpan atau update value setting.
     * Contoh penggunaan: Setting::setValue('visi', 'Visi perusahaan...')
     */
    public static function setValue(string $key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key], // Cari berdasarkan key
            ['value' => $value] // Update atau create dengan value ini
        );
    }
}
<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Jika pakai Filament:
// use Filament\Models\Contracts\FilamentUser;
// use Filament\Panel;

// Jika pakai Filament: implements FilamentUser
class User extends Authenticatable /* implements FilamentUser */
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array // Format baru di Laravel 10+
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Jika pakai Filament:
    // public function canAccessPanel(Panel $panel): bool
    // {
    //     // Tambahkan logika di sini jika perlu membatasi akses admin panel
    //     // Misalnya berdasarkan role atau email tertentu
    //     // return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
    //     return true; // Izinkan semua user (default)
    // }
}
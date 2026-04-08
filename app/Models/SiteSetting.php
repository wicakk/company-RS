<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'hospital_name',
        'hospital_tagline',
        'logo',
        'favicon',
        'address',
        'phone',
        'email',
        'hours',
        'footer_description',
        'copyright_text',
        'social_facebook',
        'social_twitter',
        'social_instagram',
        'social_youtube',
        'social_whatsapp',
    ];

    // ── Accessors ──────────────────────────────────────────────

    public function getLogoUrlAttribute(): ?string
    {
        return $this->logo
            ? asset('storage/' . $this->logo)
            : null;
    }

    public function getFaviconUrlAttribute(): ?string
    {
        return $this->favicon
            ? asset('storage/' . $this->favicon)
            : null;
    }

    /**
     * Teks copyright dengan {year} diganti tahun sekarang.
     */
    public function getCopyrightAttribute(): string
    {
        return str_replace(
            '{year}',
            date('Y'),
            $this->copyright_text ?? '© ' . date('Y') . ' RS Company. Hak cipta dilindungi undang-undang.'
        );
    }

    // ── Singleton ──────────────────────────────────────────────

    /**
     * Selalu kembalikan satu baris settings (buat jika belum ada).
     */
    public static function instance(): static
    {
        return static::firstOrCreate(
            ['id' => 1],
            [
                'hospital_name'    => 'RS Medika Nusantara',
                'hospital_tagline' => 'Kesehatan Anda Prioritas Kami',
                'footer_description' => 'Melayani masyarakat dengan penuh dedikasi sejak 1995. Didukung tenaga medis profesional dan fasilitas modern.',
                'copyright_text'   => '© {year} RS Company. Hak cipta dilindungi undang-undang.',
                'address'          => 'Jl. Kesehatan No. 1, Jakarta Selatan 12345',
                'phone'            => '(021) 1234-5678',
                'email'            => 'info@rsmedika.com',
                'hours'            => 'IGD: 24 Jam / 7 Hari',
            ]
        );
    }
}

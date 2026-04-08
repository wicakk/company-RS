<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HeroSlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'subtitle',
        'badge_text',
        'btn1_label',
        'btn1_url',
        'btn1_icon',
        'btn2_label',
        'btn2_url',
        'btn2_icon',
        'bg_image',
        'overlay_from',
        'overlay_mid',
        'overlay_to',
        'show_stats',
        'is_active',
        'order',
    ];

    protected $casts = [
        'show_stats' => 'boolean',
        'is_active'  => 'boolean',
        'order'      => 'integer',
    ];

    // ── Accessors ──────────────────────────────────────────────

    /**
     * Full public URL untuk background image.
     */
    public function getBgImageUrlAttribute(): ?string
    {
        return $this->bg_image
            ? asset('storage/' . $this->bg_image)
            : null;
    }

    // ── Scopes ─────────────────────────────────────────────────

    /**
     * Hanya slide yang aktif, urut berdasarkan kolom order.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    // ── Helpers ────────────────────────────────────────────────

    /**
     * Swap order dengan tetangga atas/bawah.
     */
    public function moveUp(): void
    {
        $neighbor = static::where('order', '<', $this->order)
            ->orderByDesc('order')
            ->first();

        if ($neighbor) {
            [$this->order, $neighbor->order] = [$neighbor->order, $this->order];
            $this->save();
            $neighbor->save();
        }
    }

    public function moveDown(): void
    {
        $neighbor = static::where('order', '>', $this->order)
            ->orderBy('order')
            ->first();

        if ($neighbor) {
            [$this->order, $neighbor->order] = [$neighbor->order, $this->order];
            $this->save();
            $neighbor->save();
        }
    }
}

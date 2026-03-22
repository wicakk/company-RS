<?php
// app/Models/Service.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'short_description', 'description',
        'icon', 'image', 'category', 'is_active', 'sort_order',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

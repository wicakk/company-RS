<?php
// app/Models/Doctor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'specialization', 'education',
        'photo', 'bio', 'str_number', 'service_id', 'is_active',
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function getPhotoUrlAttribute(): string
    {
        if ($this->photo) {
            return asset('storage/' . $this->photo);
        }
        return asset('images/doctor-placeholder.png');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

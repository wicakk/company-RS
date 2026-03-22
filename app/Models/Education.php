<?php
// app/Models/Education.php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $fillable = [
        'user_id','category_id','title','slug','excerpt','content',
        'thumbnail','video_url','type','status','published_at','views',
    ];
    protected $casts = ['published_at' => 'datetime'];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }
    public function scopePublished($query) { return $query->where('status', 'published'); }
}

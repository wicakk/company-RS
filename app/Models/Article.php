<?php
// app/Models/Article.php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','category_id','title','slug','excerpt','content',
        'thumbnail','type','status','published_at','views',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    public function user() { return $this->belongsTo(User::class); }
    public function category() { return $this->belongsTo(Category::class); }

    public function getThumbnailUrlAttribute(): ?string
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeNews($query)
    {
        return $query->where('type', 'news');
    }

    public function incrementViews()
    {
        $this->increment('views');
    }
}

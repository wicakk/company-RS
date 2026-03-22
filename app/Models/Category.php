<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug','type'];

    public function articles() { return $this->hasMany(Article::class); }
    public function educations() { return $this->hasMany(Education::class); }
}

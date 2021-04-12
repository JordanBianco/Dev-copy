<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\Likeable;
use DateTimeInterface;

class Article extends Model
{
    use HasFactory, Likeable;

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::creating(function($article) {
            $article->slug = Str::slug($article->title);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'article_category')->withTimestamps();
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'article_user')->withTimestamps();
    }

    // Trait Comment -> ? forse non necessario
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

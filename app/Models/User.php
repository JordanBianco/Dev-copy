<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public static function boot()
    {
        parent::boot();

        static::created(function($user) {
            $user->profile()->create();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function hasSaved($id)
    {
        return $this->savedArticles->contains($id);
    }

    public function articles()
    {
        return $this->hasMany(Article::class)->latest();
    }
    
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_user')->withTimestamps();
    }

    public function savedArticles()
    {
        return $this->belongsToMany(Article::class, 'article_user')->withTimestamps();
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

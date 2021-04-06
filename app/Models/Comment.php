<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Likeable;

class Comment extends Model
{
    use HasFactory, Likeable;

    protected $guarded = [];

    protected $with = ['author'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Testare
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

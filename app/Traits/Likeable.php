<?php
namespace App\Traits;

use App\Models\Like;

trait Likeable {

    public static function bootLikeable()
    {
        static::deleting(function($model) {
            $model->likes()->delete();
            $model->comments()->delete();
        });
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function hasBeenLikedByAuthUser(){
        return $this->likes->contains('user_id', auth()->id());
    }
}
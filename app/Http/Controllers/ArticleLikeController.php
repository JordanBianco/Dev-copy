<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleLikeController extends Controller
{
    public function store(Article $article)
    {        
        $like = auth()->user()->likes()
            ->where('likeable_type', get_class($article))
            ->where('likeable_id', $article->id)
            ->first();

        // If like exists si rimuove
        if ($like) {
            $like->delete();
        } else {
            $article->likes()->create([
                'user_id' => auth()->id()
            ]);
        }

        return redirect()->back();
    }
}

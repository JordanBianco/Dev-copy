<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Article $article)
    {
        auth()->user()->likes()->create([
            'likeable_id' => $article->id,
            'likeable_type' => get_class($article)
        ]);

        return redirect()->back();
    }
}

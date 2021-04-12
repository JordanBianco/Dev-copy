<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Notifications\NewArticleLikeReceived;
use Illuminate\Support\Facades\Notification;

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

            Notification::send($article->author, new NewArticleLikeReceived(auth()->user()->username, $article));
        }

        return redirect()->back();
    }
}

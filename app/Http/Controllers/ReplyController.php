<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function create(Article $article, Comment $comment)
    {
        return view('comment.reply.create', compact(['article', 'comment']));
    }

    public function store(Request $request, Article $article, Comment $comment)
    {
        $request->validate([
            'body' => 'required|max:3000'
        ]);

        $comment->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        return redirect()->route('article.show', [$article->author->name, $article->slug]);
    }
}

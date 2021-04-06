<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Article $article, Request $request)
    {
        $request->validate([
            'body' => 'required|max:3000'
        ]);

        auth()->user()->comments()->create([
            'commentable_id' => $article->id,
            'commentable_type' => get_class($article),
            'body' => $request->body,
        ]);

        return back();
    }

    public function edit(Article $article, Comment $comment)
    {
        abort_if(auth()->id() != $comment->author->id, 403);
        
        return view('comment.edit', compact(['article', 'comment']));
    }

    public function update(Request $request, Article $article, Comment $comment)
    {
        abort_if(auth()->id() != $comment->author->id, 403);

        $request->validate([
            'body' => 'required|max:1000'
        ]);

        $comment->update([
            'body' => $request->body
        ]);

        return redirect()->route('article.show', [$article->author->name, $article->slug]);   
    }

    public function destroy(Article $article, Comment $comment)
    {
        abort_if(auth()->id() != $comment->author->id, 403);
        
        $comment->delete();

        return redirect()->route('article.show', [$article->author->name, $article->slug]);
    }
}

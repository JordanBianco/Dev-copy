<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\NewCommentReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function index(User $user)
    {
        $comments = $user->comments->load('commentable');

        return view('user.profile.comment.index', compact(['user', 'comments']));
    }

    public function show(User $user, Comment $comment)
    {
        return view('user.profile.comment.show', compact('comment'));
    }

    public function store(Article $article, Request $request)
    {
        $request->validate([
            'body' => 'required|max:3000'
        ]);

        $comment = auth()->user()->comments()->create([
            'commentable_id' => $article->id,
            'commentable_type' => get_class($article),
            'body' => $request->body,
        ]);

        Notification::send($article->author, new NewCommentReceived($article, $comment));

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

        return redirect()->route('article.show', [$article->author->username, $article->slug]);   
    }

    public function destroy(Article $article, Comment $comment)
    {
        abort_if(auth()->id() != $comment->author->id, 403);
        
        $comment->delete();

        return redirect()->route('article.show', [$article->author->username, $article->slug]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Notifications\NewReplyReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

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

        $reply = $comment->comments()->create([
            'user_id' => auth()->id(),
            'body' => $request->body
        ]);

        Notification::send($comment->author, new NewReplyReceived($reply, $comment, $article));

        return redirect()->route('article.show', [$article->author->username, $article->slug]);
    }
}

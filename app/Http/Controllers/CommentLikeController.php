<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\NewCommentLikeReceived;
use Illuminate\Support\Facades\Notification;

class CommentLikeController extends Controller
{
    public function store(Comment $comment)
    {
        $like = auth()->user()->likes()
            ->where('likeable_type', get_class($comment))
            ->where('likeable_id', $comment->id)
            ->first();
        
        if ($like) {
            $like->delete();
        } else {
            $comment->likes()->create([
                'user_id' => auth()->id(),
            ]);

            Notification::send($comment->author, new NewCommentLikeReceived(auth()->user()->username, $comment));
        }
                
        return back();
    }
}

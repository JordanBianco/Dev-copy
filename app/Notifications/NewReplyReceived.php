<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReplyReceived extends Notification
{
    use Queueable;

    public $reply;
    public $comment;
    public $article;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($reply, $comment, $article)
    {
        $this->reply = $reply;
        $this->comment = $comment;
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'reply' => $this->reply->load('author'),
            'comment' => $this->comment->body,
            'article' => $this->article->load('author')
        ];
    }
}

<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCommentReceived extends Notification
{
    use Queueable;

    public $article;
    public $comment;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($article, $comment)
    {
        $this->article = $article;
        $this->comment = $comment;
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
            'article' => $this->article,
            'comment' => $this->comment->load('author')
        ];
    }
}

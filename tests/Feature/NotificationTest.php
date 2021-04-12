<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\NewArticleLikeReceived;
use App\Notifications\NewArticlePublished;
use App\Notifications\NewCommentLikeReceived;
use App\Notifications\NewCommentReceived;
use App\Notifications\NewFollower;
use App\Notifications\NewReplyReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_his_notifications()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('user.notification'))->assertOk();
    }

    public function test_user_is_notified_if_someone_follows_him()
    {
        Notification::fake();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        // Utente 1 segue utente 2
        $this->actingAs($user);
        $this->post(route('user.follow', $user2->username));

        // Utente 2 riceve notifica
        Notification::assertSentTo(
            [$user2], NewFollower::class
        );
    }

    public function test_followers_are_notified_when_the_user_write_an_article()
    {
        Notification::fake();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        // Utente 1 segue utente 2
        $this->actingAs($user);
        $this->post(route('user.follow', $user2->username));

        // Utente 2 crea articolo
        $this->actingAs($user2);

        $category = Category::factory()->create();
        $data = [
            'user_id' => $user2->id,
            'title' => 'new title',
            'body' => 'new body',
            'categories' => $category->id
        ];
        $this->post(route('article.store'), $data);

        // Utente 1 che segue utente 2, riceve notifica
        Notification::assertSentTo(
            [$user], NewArticlePublished::class
        );
    }

    public function test_author_of_the_article_is_notified_when_someone_comments()
    {
        Notification::fake();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        // Utente 1 crea articolo
        $article = Article::factory()->create([
            'user_id' => $user->id
        ]);

        // Utente 2 commenta
        $this->actingAs($user2);
        $this->post(route('article.comment.store', $article->id), [
            'user_id' => $user2->id,
            'commentable_id' => $article->id,
            'commentable_type' => get_class($article),
            'body' => 'Body',
        ]);

        // utente 1 riceve notifica
        Notification::assertSentTo(
            [$user], NewCommentReceived::class
        );
    }

    public function test_author_of_the_comment_is_notified_if_someone_replies()
    {
        Notification::fake();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        $article = Article::factory()->create();

        // utente 1 commenta un articolo
        $this->actingAs($user);
        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        // utente 2 risponde ul commento
        $this->actingAs($user2);
        $comment = Comment::first();
        $this->post(route('comment.reply.store', [$article->slug, $comment->id]), [
            'body' => 'New Reply Body'
        ]);

        // utente 1 riceve notifica
        Notification::assertSentTo(
            [$user], NewReplyReceived::class
        );
    }

    public function test_the_author_of_the_article_is_notified_if_someone_likes_it()
    {
        Notification::fake();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        $article = Article::factory()->create(['user_id' => $user2->id]);

        // utente 1 mette mi piace all' articolo
        $this->actingAs($user);
        $this->post(route('article.like.store', $article->id));

        // utente 2 riceve notifica
        Notification::assertSentTo(
            [$user2], NewArticleLikeReceived::class
        );
    }

    public function test_the_author_of_the_comment_is_notified_if_someone_likes_it()
    {
        Notification::fake();

        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        $article = Article::factory()->create(['user_id' => $user2->id]);

        // utente 1 commenta un articolo
        $this->actingAs($user);
        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        // utente 2 mette mi piace al commento
        $this->actingAs($user);
        $comment = Comment::first();
        $this->post(route('comment.like.store', $comment->id));

        // utente 1 riceve notifica
        Notification::assertSentTo(
            [$user], NewCommentLikeReceived::class
        );
    }
}

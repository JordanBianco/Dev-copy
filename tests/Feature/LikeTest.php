<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Like;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikeTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_article_can_be_liked()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->post(route('article.like.store', $article->id));

        $this->assertEquals(1, $user->likes->count());
        $this->assertEquals(get_class($article), Like::first()->likeable_type);
        $this->assertEquals($article->id, Like::first()->likeable_id);
    }

    public function test_a_like_can_be_removed_from_an_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->post(route('article.like.store', $article->id));

        $this->assertEquals(1, $user->likes->count());

        $this->post(route('article.like.store', $article->id));

        $this->assertEquals(0, $user->likes->fresh()->count());
    }

    public function test_a_comment_can_be_liked()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $comment = Comment::factory()->create([
            'commentable_id' => $article->id
        ]);

        $this->post(route('comment.like.store', $comment->id));

        $this->assertEquals(1, $comment->likes->count());
        $this->assertEquals(get_class($comment), Like::first()->likeable_type);
        $this->assertEquals($comment->id, Like::first()->likeable_id);
    }

    public function test_a_like_can_be_removed_from_a_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();
        
        $comment = Comment::factory()->create([
            'commentable_id' => $article->id
        ]);

        $this->post(route('comment.like.store', $comment->id));

        $this->assertEquals(1, $comment->likes->count());

        $this->post(route('comment.like.store', $comment->id));

        $this->assertEquals(0, $comment->likes->fresh()->count());
    }
}

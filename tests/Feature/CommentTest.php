<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_an_article_can_be_commented()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        $this->assertEquals(1, $user->comments->count());
        $this->assertEquals(get_class($article), Comment::first()->commentable_type);
        $this->assertEquals($article->id, Comment::first()->commentable_id);
    }

    public function test_a_comment_body_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->post(route('article.comment.store', $article->id), [
            'body' => ''
        ])->assertSessionHasErrors('body');

        $this->assertEquals(0, $user->comments->count());
    }

    public function test_comment_are_visible_on_article_show_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();
        
        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        $comment = Comment::first();

        $this->get(route('article.show', [$article->author->username, $article->slug]))
            ->assertSee($comment->body)
            ->assertSee($comment->author->name)
            ->assertSee($comment->created_at->format('M d'));
    }

    public function test_author_can_delete_a_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();
        
        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        $comment = Comment::first();

        $this->assertDatabaseHas('comments', $comment->only('id'));

        $this->delete(route('article.comment.destroy', [$article->id, $comment->id]))
            ->assertRedirect(route('article.show', [$article->author->username, $article->slug]));

        $this->assertDatabaseMissing('comments', $comment->only('id'));
    }

    public function test_author_can_delete_only_its_own_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $user2 = User::factory()->create();        

        $article = Article::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user2->id,
            'commentable_id' => $article->id    
        ]);

        $this->delete(route('article.comment.destroy', [$article->id, $comment->id]))
            ->assertForbidden();

        $this->assertDatabaseHas('comments', $comment->only('id'));
    }

    public function test_author_can_view_the_edit_comment_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();
        
        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        $comment = Comment::first();

        $this->get(route('article.comment.edit', [$article->slug, $comment->id]))
            ->assertSee($comment->body);
    }

    public function test_user_can_update_a_comment()
    {        
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();
        
        $this->post(route('article.comment.store', $article->id), [
            'body' => 'New Comment Body'
        ]);

        $comment = Comment::first();

        $this->patch(route('article.comment.update', [$article->id, $comment->id]), [
            'body' => 'Updated Body'
        ])->assertRedirect(route('article.show', [$article->author->username, $article->slug]));
        
        $this->assertEquals('Updated Body', $comment->fresh()->body);
    }

    public function test_author_cannot_view_edit_page_of_others_comment_and_cannot_update_others_comment()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $user2 = User::factory()->create();        

        $article = Article::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user2->id,
            'commentable_id' => $article->id    
        ]);

        $this->get(route('article.comment.edit', [$article->slug, $comment->id]))
            ->assertForbidden();

        $this->patch(route('article.comment.update', [$article->id, $comment->id]), [
         'body' => 'Updated Body'
        ])->assertForbidden();
    }

    public function test_a_comment_can_have_many_replies()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $comment = Comment::factory()->create([
            'user_id' => $user->id,
            'commentable_id' => $article->id    
        ]);

        $this->get(route('comment.reply.create', [$article->slug, $comment->id]))
            ->assertSee($comment->body)
            ->assertSee($comment->author->name);

        $this->post(route('comment.reply.store', [$article->slug, $comment->id]), [
            'body' => 'New Reply Body'
        ]);

        $this->assertEquals(1, $comment->comments->count());
    }

    public function test_likes_and_replies_associated_to_a_comment_gets_deleted_when_the_comment_gets_deleted()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $comment = Comment::factory()->create(['user_id' => $user->id]);

        $comment->likes()->create([
            'user_id' => $user->id
        ]);

        $comment->comments()->create([
            'user_id' => $user->id,
            'body' => 'Reply body'
        ]);

        $this->assertEquals(1, $comment->likes()->count());
        $this->assertEquals(1, $comment->comments()->count());

        $this->delete(route('article.comment.destroy', [$comment->commentable_id, $comment->id]));

        $this->assertEquals(0, $comment->likes()->count());
        $this->assertEquals(0, $comment->comments()->count());
    }
}

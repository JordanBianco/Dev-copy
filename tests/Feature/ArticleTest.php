<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_list_of_the_latest_articles_is_shown_on_the_homepage()
    {
        $article = Article::factory()->create();

        $this->get(route('article.index'))
            ->assertSee($article->title)
            ->assertSee($article->created_at->format('M d'));
    }

    public function test_on_the_article_page_is_possibile_to_view_author_details()
    {
        $article = Article::factory()->create();

        $this->get(route('article.show', [$article->author->name, $article->slug]))
            ->assertSee($article->title)
            ->assertSee($article->created_at->format('M d'))
            ->assertSee($article->body)
            ->assertSee($article->author->name)
            ->assertSee($article->author->created_at->format('d M Y'));
    }

    public function test_auth_user_can_write_articles()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get(route('article.create'))->assertStatus(200);
     
        $category = Category::factory()->create();
        
        $data = [
            'user_id' => $user->id,
            'title' => 'new title',
            'body' => 'new body',
            'categories' => $category->id
        ];

        $this->post(route('article.store'), $data)
            ->assertRedirect(route('dashboard.index'));

        $this->assertEquals(1, $user->articles->count());
    }

    public function test_title_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = [
            'user_id' => $user->id,
            'title' => '',
            'body' => 'new body',
        ];

        $this->post(route('article.store'), $article)
            ->assertSessionHasErrors('title');
        
        $this->assertDatabaseMissing('articles', $article);
    }

    public function test_body_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = [
            'user_id' => $user->id,
            'title' => 'title',
            'body' => '',
        ];

        $this->post(route('article.store'), $article)
            ->assertSessionHasErrors('body');
        
        $this->assertDatabaseMissing('articles', $article);
    }

    public function test_at_least_one_category_is_required()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = [
            'user_id' => $user->id,
            'title' => 'title',
            'body' => 'body',
        ];

        $this->post(route('article.store'), $article)
            ->assertSessionHasErrors('categories');
    }

    public function test_when_visit_article_page_it_s_views_counter_increments()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->assertEquals(0, $article->views_count);

        $this->get(route('article.show', [$article->author->name, $article->slug]))->assertOk();
        
        $this->assertEquals(1, $article->refresh()->views_count);
    }
}

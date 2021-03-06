<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Article;
use App\Models\Like;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_article_belongs_to_an_owner()
    {
        $article = Article::factory()->create();

        $this->assertInstanceOf(User::class, $article->author);
    }

    public function test_an_article_can_have_many_categories()
    {
        $article = Article::factory()->create();

        $this->assertInstanceOf(Collection::class, $article->categories);
    }

    // many to many
    public function test_article_can_be_saved_by_many_users()
    {
        $article = Article::factory()->create();

        $this->assertInstanceOf(Collection::class, $article->users);
    }

    public function test_article_can_have_many_likes()
    {
        $article = Article::factory()->create();

        $this->assertInstanceOf(Collection::class, $article->likes);
    }

    public function test_article_can_have_many_comments()
    {
        $article = Article::factory()->create();

        $this->assertInstanceOf(Collection::class, $article->comments);
    }
}

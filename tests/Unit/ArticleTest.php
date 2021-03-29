<?php

namespace Tests\Unit;

use App\Models\User;
use App\Models\Article;
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
}

<?php

namespace Tests\Unit;

use App\Models\Article;
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

        $this->assertEquals(get_class($article), Like::first()->likeable_type);
        $this->assertEquals($article->id, Like::first()->likeable_id);
    }
}

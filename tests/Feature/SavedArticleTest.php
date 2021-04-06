<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SavedArticleTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_articles_in_saved()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();
        $this->post(route('saved.store', $article->id));

        $this->get(route('dashboard.saved'))
            ->assertSee($user->savedArticles->first()->title);
    }

    public function test_user_can_save_articles_in_saved_list()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->post(route('saved.store', $article->id));

        $this->assertEquals(1, $user->savedArticles->count());
    }
}

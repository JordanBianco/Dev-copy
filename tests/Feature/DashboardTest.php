<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_articles_are_shown_in_the_dashboard()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create(['user_id' => $user->id]);

        $this->get(route('dashboard.index'))
            ->assertSee($article->title);
    }

    public function test_user_following_categories_are_shown_in_the_dashboard_following_categories_subpage()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        
        $user->categories()->attach($category->id);

        $this->get(route('dashboard.following_categories'))
            ->assertSee($category->name);
    }
}

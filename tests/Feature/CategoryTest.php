<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_list_of_popular_tags_is_shown_in_the_homepage()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $this->get(route('article.index'))
            ->assertSee($category1->name)
            ->assertSee($category2->name);
    }

    public function test_the_list_of_all_the_categories_is_shown()
    {
        $category1 = Category::factory()->create();
        $category2 = Category::factory()->create();

        $this->get(route('category.index'))
            ->assertSee($category1->name)
            ->assertSee($category2->name);
    }

    public function test_on_the_single_category_page_there_is_the_list_of_the_related_articles()
    {
        $category = Category::factory()->create();

        $article = Article::factory()->create();

        $category->articles()->attach($article->id);

        $this->assertEquals(1, $category->articles->count());

        $this->get(route('category.show', $category->name))
            ->assertSee($category->title)
            ->assertSee($category->description)
            ->assertSee($article->title);
    }

    public function test_category_can_be_followed_by_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = Category::factory()->create();
        $article = Article::factory()->create();
        $category->articles()->attach($article->id);

        $this->assertEquals(1, $category->articles->count());

        $this->post(route('category.follow', $category->name));

        $this->assertEquals(1, $category->users->count());
    }
}

<?php

namespace Tests\Unit;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_category_can_have_many_articles()
    {
        $category = Category::factory()->create();

        $this->assertInstanceOf(Collection::class, $category->articles);
    }

    public function test_a_category_can_be_followed_by_multiple_users()
    {
        $category = Category::factory()->create();

        $this->assertInstanceOf(Collection::class, $category->users);
    }
}

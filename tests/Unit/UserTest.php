<?php

namespace Tests\Unit;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_write_many_articles()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->articles);
    }

    public function test_profile_its_created_when_user_register()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Profile::class, $user->profile);
    }

    // many to many
    public function test_user_can_follow_many_categories()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->categories);
    }

    // many to many
    public function test_user_can_save_many_articles()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->savedArticles);
    }

    // many to many
    public function test_user_can_likes_many_articles()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->likes);
    }

    public function test_user_can_post_many_comments()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->comments);
    }
}

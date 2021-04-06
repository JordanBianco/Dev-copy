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

    public function test_a_like_belongs_to_user()
    {
       Like::factory()->create();

        $this->assertInstanceOf(User::class, Like::first()->author);
    }
}

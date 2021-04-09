<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_follow_many_users()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->following);
    }
}

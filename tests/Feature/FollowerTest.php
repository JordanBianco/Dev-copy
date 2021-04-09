<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowerTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_follow_another_user()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        $this->actingAs($user);

        $this->post(route('user.follow', $user2->username));

        $this->assertEquals(1, $user->following->count());
    }

    public function test_user_can_view_who_he_follows()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        $this->actingAs($user);

        $this->post(route('user.follow', $user2->username));

        $this->get(route('dashboard.following_user'))
            ->assertSee($user->following->first()->name);
        
        $this->assertEquals($user2->name, $user->following->first()->name);
    }

    public function test_user_can_view_who_his_followers()
    {
        $user = User::factory()->create();
        $user2 = User::factory()->create();
        
        $this->actingAs($user);

        $this->post(route('user.follow', $user2->username));

        $this->actingAs($user2);

        $this->get(route('dashboard.followers'))
            ->assertSee($user2->followers->first()->name);

        $this->assertEquals($user->name, $user2->followers->first()->name);
    }
}

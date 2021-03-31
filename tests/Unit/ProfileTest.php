<?php

namespace Tests\Unit;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_profile_belongs_to_a_user()
    {
        $profile = Profile::factory()->create();

        $this->assertInstanceOf(User::class, $profile->user);
    }
}

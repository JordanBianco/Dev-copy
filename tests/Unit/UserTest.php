<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_user_can_write_many_articles()
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(Collection::class, $user->articles);
    }
}

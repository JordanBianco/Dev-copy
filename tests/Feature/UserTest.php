<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_an_article()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $article = Article::factory()->create();

        $this->post(route('article.like.store', $article->id));

        $this->assertEquals(1, $user->likes->count());
    }

    // public function test_user_is_notified_when_a_following_user_posts_a_new_article()
    // {
    //     $user = User::factory()->create();
    //     $user2 = User::factory()->create();
        
    //     $this->actingAs($user);

    //     $this->post(route('user.follow', $user2->username));

    //     Article::factory()->create([
    //         'user_id' => $user2->id
    //     ]);

    //     Notification::fake();

    //     Notification::assertSentTo(
    //         [$user], NewArticlePublished::class
    //     );
    // }
}

<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use App\Notifications\NewCommentReceived;
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

    public function test_user_can_delete_its_account()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->delete(route('user.delete', $user->id))->assertRedirect(route('article.index'));

        $this->assertEquals(0, User::all()->count());
    }
}

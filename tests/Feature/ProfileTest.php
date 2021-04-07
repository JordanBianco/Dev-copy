<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_every_user_has_a_profile()
    {
        $user = User::factory()->create();

        Article::factory()->create(['user_id' => $user->id]);

        $this->get(route('user.profile', $user->username))
            ->assertSee($user->name) 
            ->assertSee($user->profile->bio) 
            ->assertSee($user->created_at->format('d M Y'))
            ->assertSee($user->articles->first()->title);
    }

    public function test_user_can_edit_his_profile_info()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('user.settings.profile.edit'))
                ->assertSee($user->name)
                ->assertSee($user->email);
    }

    public function test_name_is_required_when_updating_profile()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('user.settings.update', [
                'name' => '',
            ]))->assertSessionHasErrors('name');
    }

    public function test_email_is_required_when_updating_profile_and_must_be_unique()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('user.settings.update', [
                'email' => '',
            ]))->assertSessionHasErrors('email');
    }

    public function test_user_can_update_his_account_info()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('user.settings.update', [
                'name' => 'Updated Name',
                'email' => 'Updated Email',
                'username' => 'Updated Username',
            ]));

        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('Updated Email', $user->email);
        $this->assertEquals('Updated Username', $user->username);
    }

    public function test_user_can_update_his_profile_info()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('user.settings.update-profile', [
                'bio' => 'Updated BIO',
            ]));

        $this->assertEquals('Updated BIO', $user->profile->bio);
    }

    public function test_user_profile_info_can_be_null()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('user.settings.update-profile', [
                'bio' => '',
            ]))->assertSessionHasNoErrors();
    }


    public function test_user_profile_website_must_be_an_url()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('user.settings.update-profile', [
                'website_url' => 'New url',
            ]))->assertSessionHasErrors('website_url');
    }

    // public function test_user_can_update_his_coding_info()
    // {
    //     $user = User::factory()->create();

    //     $this->actingAs($user)
    //         ->patch(route('user.settings.update', [
    //             'available_for' => 'Updated Name',
    //             'email' => 'Updated Email',
    //             'username' => 'Updated Username',
    //         ]));

    //     $this->assertEquals('Updated Name', $user->name);
    //     $this->assertEquals('Updated Email', $user->email);
    //     $this->assertEquals('Updated Username', $user->username);
    // }
}

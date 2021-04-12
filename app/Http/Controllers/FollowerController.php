<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewFollower;
use Illuminate\Support\Facades\Notification;

class FollowerController extends Controller
{
    public function index()
    {
        $following = auth()->user()->following;

        return view('user.dashboard.following_user', compact('following'));
    }

    public function followers()
    {
        $followers = auth()->user()->followers;

        return view('user.dashboard.followers', compact('followers'));
    }

    public function store(User $user)
    {
        auth()->user()->following()->toggle($user->id);
        
        if (auth()->user()->isFollowing($user)) {
            Notification::send($user, new NewFollower(auth()->user()->username));
        }
        
        return back();
    }
}

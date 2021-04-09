<?php

namespace App\Http\Controllers;

use App\Models\User;

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

        return back();
    }
}

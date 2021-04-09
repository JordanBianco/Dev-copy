<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $comments = $user->comments->take(8)->load('commentable');

        return view('user.profile.index', compact(['user', 'comments']));
    }

    public function edit()
    {
        return view('user.settings.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'. auth()->id(),
            'username' => 'required|alpha_dash|unique:users,username,' . auth()->id(),
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return back();
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|max:200',
            'website_url' => 'nullable|url',
            'location' => 'nullable|string',
        ]);

        auth()->user()->profile()->update([
            'bio' => $request->bio,
            'website_url' => $request->website_url,
            'location' => $request->location,
        ]);

        return back();
    }
}

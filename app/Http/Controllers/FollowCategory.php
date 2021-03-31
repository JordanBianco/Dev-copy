<?php

namespace App\Http\Controllers;

use App\Models\Category;

class FollowCategory extends Controller
{
    public function store(Category $category)
    {
        if ($category->users->pluck('id')->contains(auth()->id())) {
            $category->users()->detach(auth()->id());
        } else {
            $category->users()->attach(auth()->id());
        }
        return back();
    }
}

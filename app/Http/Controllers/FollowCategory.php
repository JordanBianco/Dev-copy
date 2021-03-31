<?php

namespace App\Http\Controllers;

use App\Models\Category;

class FollowCategory extends Controller
{
    public function store(Category $category)
    {
        $category->users()->toggle(auth()->id());
        
        return back();
    }
}

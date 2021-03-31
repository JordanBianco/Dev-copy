<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $articles = Article::where('user_id', auth()->id())
                        ->with('categories')
                        ->latest()
                        ->get();

        return view('user.dashboard.index', compact('articles'));
    }
}

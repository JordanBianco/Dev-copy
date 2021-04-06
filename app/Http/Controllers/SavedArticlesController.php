<?php

namespace App\Http\Controllers;

use App\Models\Article;

class SavedArticlesController extends Controller
{
    public function index()
    {
        $articles = auth()->user()->savedArticles;

        return view('user.dashboard.saved', compact('articles'));
    }

    public function store(Article $article)
    {
        auth()->user()->savedArticles()->toggle($article->id);

        return redirect()->back();
    }
}

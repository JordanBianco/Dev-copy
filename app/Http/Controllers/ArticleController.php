<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')->latest()->get();

        return view('article.index', compact('articles'));
    }
    
    public function show(User $user, Article $article)
    {
        // $articles = Article::with('author')->latest()->get();
        return view('article.show', compact(['user', 'article']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')
            ->with('categories')
            ->latest()
            ->get();
        
        // piU POPOLARI, quindi le categorie   
        $categories = Category::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->get();

        return view('article.index', compact(['articles', 'categories']));
    }
    
    public function show(User $user, Article $article)
    {
        return view('article.show', compact(['user', 'article']));
    }
}

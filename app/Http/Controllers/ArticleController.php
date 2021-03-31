<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')
            ->with('categories')
            ->latest()
            ->get();
        
        // categorie con più articoli
        $categories = Category::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->get();

        return view('article.index', compact(['articles', 'categories']));
    }
    
    public function show(User $user, Article $article)
    {
        $article->views_count = $article->views_count + 1;
        $article->save();
        
        return view('article.show', compact(['user', 'article']));
    }

    public function create()
    {
        $categories = Category::all();

        return view('article.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'body' => 'required',
            'categories' => 'required|exists:categories,id'
        ]);

        $article = auth()->user()->articles()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        $article->categories()->attach($request->categories);

        return redirect()->route('dashboard.index');
    }
}

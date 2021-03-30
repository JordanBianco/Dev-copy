<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('articles')->orderBy('articles_count')->get();

        return view('category.index', compact('categories'));
    }

    public function show(Category $category)
    {
        $articles = $category->articles->load('author', 'categories');
        $latestArticles = $articles->sortByDesc('created_at')->take(6);

        return view('category.show', compact(['category', 'articles', 'latestArticles']));
    }
}

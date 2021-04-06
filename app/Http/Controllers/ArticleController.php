<?php

namespace App\Http\Controllers;

use App\Mail\NewArticleCreated;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')
            ->with('categories')
            ->withCount(['likes', 'users', 'comments'])
            ->latest()
            ->paginate(20);
        
        // categorie con più articoli
        $categories = Category::withCount('articles')
            ->orderBy('articles_count', 'desc')
            ->get();

        return view('article.index', compact('articles', 'categories'));
    }
    
    public function show(User $user, Article $article)
    {
        $article->views_count = $article->views_count + 1;
        $article->save();

        $article = Article::where('id', $article->id)
            ->with('likes', 'users', 'comments')
            ->first();

        return view('article.show', compact('article'));
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

        Mail::to($article->author->email)
            ->send(new NewArticleCreated($article));

        return redirect()->route('dashboard.index');
    }

    public function destroy(Article $article)
    {
        abort_if(auth()->id() !== $article->author->id, 403);

        $article->delete();

        return back();
    }
}

<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowCategory;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SavedArticlesController;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::view('/following_categories', 'user.dashboard.following_categories')->name('dashboard.following_categories');
        Route::get('/saved', [SavedArticlesController::class, 'index'])->name('dashboard.saved');
    });

    // SavedForLater
    Route::post('/save/{article:id}', [SavedArticlesController::class, 'store'])->name('saved.store');

    // Articles
    Route::get('/new', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/', [ArticleController::class, 'store'])->name('article.store');

    // Follow
    Route::post('/c/{category:name}/follow', [FollowCategory::class, 'store'])->name('category.follow');

    // Likes
    Route::post('/article/{article:id}/like', [LikeController::class, 'store'])->name('article.like.store');

});

// Category
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/c/{category:name}', [CategoryController::class, 'show'])->name('category.show');

// Articles
Route::get('/', [ArticleController::class, 'index'])->name('article.index');
Route::get('/{user:name}/{article:slug}', [ArticleController::class, 'show'])->name('article.show');
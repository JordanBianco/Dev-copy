<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FollowCategory;
use App\Http\Controllers\ArticleLikeController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\SavedArticlesController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::prefix('dashboard')->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::view('/following_categories', 'user.dashboard.following_categories')->name('dashboard.following_categories');
        Route::get('/saved', [SavedArticlesController::class, 'index'])->name('dashboard.saved');
        Route::get('/following_user', [FollowerController::class, 'index'])->name('dashboard.following_user');
        Route::get('/followers', [FollowerController::class, 'followers'])->name('dashboard.followers');
    });
    
    // Follower
    Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('user.follow');

    // SavedForLater
    Route::post('/save/{article:id}', [SavedArticlesController::class, 'store'])->name('saved.store');

    // Articles
    Route::get('/new', [ArticleController::class, 'create'])->name('article.create');
    Route::post('/', [ArticleController::class, 'store'])->name('article.store');
    Route::delete('article/{article:id}', [ArticleController::class, 'destroy'])->name('article.destroy');

    // Follow
    Route::post('/c/{category:name}/follow', [FollowCategory::class, 'store'])->name('category.follow');

    // Likes
    Route::post('/article/{article:id}/like', [ArticleLikeController::class, 'store'])->name('article.like.store');
    Route::post('/comment/{comment:id}/like', [CommentLikeController::class, 'store'])->name('comment.like.store');

    // Comment
    Route::get('/article/{article:slug}/comment/{comment:id}', [CommentController::class, 'edit'])->name('article.comment.edit');
    Route::patch('/article/{article:id}/comment/{comment:id}', [CommentController::class, 'update'])->name('article.comment.update');
    Route::post('/article/{article:id}/comment', [CommentController::class, 'store'])->name('article.comment.store');
    Route::delete('/article/{article:id}/comment/{comment:id}', [CommentController::class, 'destroy'])->name('article.comment.destroy');

    // Replies
    Route::get('/article/{article:slug}/comment/{comment:id}/reply', [ReplyController::class, 'create'])->name('comment.reply.create');
    Route::post('/article/{article:slug}/comment/{comment:id}/reply', [ReplyController::class, 'store'])->name('comment.reply.store');

    // Profile
    Route::get('/settings', [ProfileController::class, 'edit'])->name('user.settings.profile.edit');
    Route::patch('/settings/user', [ProfileController::class, 'update'])->name('user.settings.update');
    Route::patch('/settings/user/profile', [ProfileController::class, 'updateProfile'])->name('user.settings.update-profile');
});

// Comments
Route::get('/{user:username}/comment/{comment:id}', [CommentController::class, 'show'])->name('user.profile.comment.show');
Route::get('/{user:username}/comments', [CommentController::class, 'index'])->name('user.profile.comment.index');

// Category
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/c/{category:name}', [CategoryController::class, 'show'])->name('category.show');

// Articles
Route::get('/', [ArticleController::class, 'index'])->name('article.index');
Route::get('/{user:username}/{article:slug}', [ArticleController::class, 'show'])->name('article.show');

// Profile
Route::get('/{user:username}', [ProfileController::class, 'index'])->name('user.profile');
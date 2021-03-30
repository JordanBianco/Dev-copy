<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::get('/c/{category:name}', [CategoryController::class, 'show'])->name('category.show');
// Articles
Route::get('/', [ArticleController::class, 'index'])->name('article.index');
Route::get('/{user:name}/{article:slug}', [ArticleController::class, 'show'])->name('article.show');

// Category
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');


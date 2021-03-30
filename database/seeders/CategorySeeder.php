<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory()->count(20)->create();
        Article::factory()->count(10)->create();

        $articles = Article::all();
        $categories = Category::all()->pluck('id')->toArray();

        $articles->map(function($article) use ($categories) {
            $article->categories()->attach(array_rand($categories, 4));
        });
    }
}

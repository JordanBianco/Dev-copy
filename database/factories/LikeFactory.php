<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Like;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Like::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $article = Article::factory()->create();

        return [
            'user_id' => User::factory(),
            'likeable_type' => get_class($article),
            'likeable_id' => $article->id,
        ];
    }
}

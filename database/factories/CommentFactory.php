<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

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
            'commentable_type' => get_class($article),
            'commentable_id' => $article->id,
            'body' => $this->faker->sentence,
        ];
    }
}

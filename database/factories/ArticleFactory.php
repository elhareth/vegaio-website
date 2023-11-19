<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use App\Enums\ArticleStatus;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 5),
            // 'slug' => $this->faker->unique()->slug(rand(3, 5)),
            // 'title' => $this->faker->words(5, true),
            // 'content' => $this->faker->paragraphs(7, true),
            'slug' => md5(now()->timestamp . uniqid()),
            'title' => Str::random(15),
            'content' => Str::random(100),
            'status' => Arr::random(ArticleStatus::cases()),
            'published_at' => now()
                ->subDays(rand(1, 100))
                ->addMinutes(rand(10, 500))
                ->subSeconds(rand(10, 50)),
        ];
    }
}

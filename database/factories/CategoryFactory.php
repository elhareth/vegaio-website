<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => null,
            // 'slug' => $this->faker->unique()->slug(),
            'slug' => md5(now()->timestamp . uniqid()),
            // 'name' => $this->faker->unique()->creditCardType(),
            'group' => null,
            // 'title' => $this->faker->words(rand(2,4), true),
            // 'description' => $this->faker->sentence(10),
        ];
    }
}

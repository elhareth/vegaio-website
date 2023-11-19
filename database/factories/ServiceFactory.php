<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => null,
            // 'slug' => $this->faker->unique()->slug(),
            'slug' => md5(now()->timestamp . uniqid()),
            // 'name' => $this->faker->unique()->userName(),
            // 'label' => $this->faker->creditCardType(),
            // 'description' => $this->faker->paragraphs(2, true),
        ];
    }
}

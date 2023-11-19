<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=SiteOption>
 */
class SiteOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->unique()->slug(2),
            'name' => md5(now()->timestamp . uniqid()),
            'label' => null,
            'value' => null,
            'group' => null,
            'autoload' => true,
        ];
    }
}

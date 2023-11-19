<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactMessage>
 */
class ContactMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            // 'name' => $this->faker->name,
            // 'email' => $this->faker->safeEmail,
            // 'subject' => $this->faker->words(rand(2,5), true),
            // 'message' => $this->faker->realText,
            'read' => rand(true, false),
            'added' => now()
                ->subDays(rand(1, 10))
                ->addHours(rand(1, 100))
                ->subMinute(rand(1, 100))
                ->addSeconds(rand(1, 100)),
        ];
    }
}

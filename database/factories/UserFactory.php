<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use App\Enums\UserRole;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'username' => fake()->unique()->userName(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
            'user_status' => UserStatus::PENDING,
            'user_role' => UserRole::USER,
            'user_info' => [
                'locale'        => 'ar',
                'avatar'        => null,
                'gender'        => null,
                'birthdate'     => null,
                'last_login'    => null,
                'last_activity' => null,
            ],
            'activated_at' => null,
            'email_verified_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}

<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            "email" => fake()->unique()->email(), 
            "password" => '$2y$10$qKab/so2IGMFYEicBDczpeDh7Z7EMHdHYvGu.W8rJt7zewLuVKI2q',
            "first_name" => fake()->word(),
            "last_name" => fake()->word(),
            "birth_date" => fake()->date(),
            "created_at" => fake()->date(),
            "updated_at" => fake()->date(),
            "remember_token" => Str::random(10)
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reference>
 */
class ReferenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "description" => fake()->sentence(),
            "area" => fake()->word(),
            "hard_skill_values" => implode(",", fake()->words(6)),
            "soft_skill_values" => implode(",", fake()->words(6)),
            "duration" => fake()->date(),
            "ref_first_name" => fake()->word(),
            "ref_last_name" => fake()->word(),
            "ref_birth_date" => fake()->date(),
            "ref_mail" => fake()->email(),
            "validated" => fake()->boolean(),
            "expire_at" => fake()->date(),
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Domain>
 */
class DomainFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'domain' => $this->faker->url,
            'is_blocked' => $this->faker->boolean,
            'status' => $this->faker->boolean,
            'priority' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}

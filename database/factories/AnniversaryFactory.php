<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AnniversaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'user_id' => 1,
            'title' => fake()->title,
            'name' => fake()->name,
            'phone' => fake()->phoneNumber,
            'email' => fake()->email,
            'wedding' => fake()->dateTimeBetween('-30 years', 'now')->format('Y-m-d'),
            'birthday' => fake()->dateTimeBetween('-70 years', '-18 years')->format('Y-m-d'),
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

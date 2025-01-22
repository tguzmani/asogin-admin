<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Membership>
 */
class MembershipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 year', 'now'); // Random start date within the last year
        $endDate = $this->faker->optional(0.7, null)->dateTimeBetween($startDate, '+1 year'); // 70% chance of having an end date

        $memberships = ['basico', 'piscina', 'especial', 'entrenador', 'personalizado'];

        $name = $this->faker->randomElement($memberships);

        $base_price = [
            'basico' => 20,
            'piscina' => 30,
            'especial' => 40,
            'entrenador' => 50,
            'personalizado' => 60,
        ][$name];

        return [
            'name' => $name,
            'description' => $this->faker->text($this->faker->randomElement([10, 20, 30])),
            'base_price' => $base_price,
        ];
    }
}

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

        $users = Member::pluck('id')->toArray();

        return [
            'member_id' => $this->faker->randomElement($users), // Create or use an existing Member
            'membership_type' => $this->faker->randomElement(['special', 'basic', 'premium', 'annual', 'monthly']),
            'start_date' => $startDate,
            'end_date' => $endDate,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}

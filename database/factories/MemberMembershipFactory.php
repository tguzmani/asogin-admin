<?php

namespace Database\Factories;

use App\Models\Member;
use App\Models\Membership;
use App\Models\MemberMembership;
use Illuminate\Database\Eloquent\Factories\Factory;

class MemberMembershipFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = MemberMembership::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $membership = Membership::all()->random();
        $member_id = Member::all()->random()->id;

        return [
            'membership_id' => $membership->id,
            'member_id' => $member_id,
            'start_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'end_date' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
            'price' => $membership->base_price,
        ];
    }
}

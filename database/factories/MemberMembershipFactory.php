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

        $start_date = $this->faker->dateTimeBetween('-1 year', 'now');

        return [
            'membership_id' => $membership->id,
            'member_id' => $member_id,
            'start_date' => $start_date,
            'end_date' => (clone $start_date)->modify('+1 month'),
            'price' => $membership->base_price,
        ];
    }

    public function runningMembership(): static
    {
        return $this->state(function () {
            $membership = Membership::all()->random();
            $member_id = Member::all()->random()->id;

            $start_date = now()->subDays(rand(0, 30));

            $addFunction = match ($membership->duration_unit) {
                'day' => 'addDays',
                'week' => 'addWeeks',
                'month' => 'addMonths',
                'year' => 'addYears',
            };

            $end_date = now()->$addFunction($membership->duration);

            return [
                'membership_id' => $membership->id,
                'member_id' => $member_id,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'price' => $membership->base_price,
            ];
        });
    }
}

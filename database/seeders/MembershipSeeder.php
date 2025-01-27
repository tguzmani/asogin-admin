<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Membership;

class MembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $memberships = [
            'basico' => 20,
            'full' => 70,
            'piscina' => 30,
            'especial' => 40,
            'entrenador' => 50,
            'personalizado' => 60,
        ];

        foreach ($memberships as $name => $base_price) {
            Membership::create([
                'name' => $name,
                'description' => fake()->text(fake()->randomElement([10, 20, 30])),
                'base_price' => $base_price,
                'duration' => fake()->randomElement([1, 1, 1, 1, 1, 3, 6]),
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\MemberMembership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberMembershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberMembership::factory()->count(30)->create();
        MemberMembership::factory()->runningMembership()->count(10)->create();
    }
}

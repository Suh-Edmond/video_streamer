<?php

namespace Database\Seeders;

use App\Constant\UserRole;
use App\Constant\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make("password123"),
                'status' => $faker->randomElement([UserStatus::ACTIVE, UserStatus::IN_ACTIVE]),
                'role'   => UserRole::USER,
            ]);
        }
    }
}

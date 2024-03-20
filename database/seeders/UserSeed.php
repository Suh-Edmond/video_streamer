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
        User::create([
            'name'     => $faker->name,
            'email'    => 'etha22@gmail.com',
            'password' => Hash::make("password123"),
            'status'   => UserStatus::ACTIVE,
            'role'     => UserRole::ADMIN,
        ]);
    }
}

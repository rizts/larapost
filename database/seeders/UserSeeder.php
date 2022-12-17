<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                "name" => "Admin",
                "email" => "admin@larapost.local",
                "password" => Hash::make("11223344"),
            ],
            [
                "name" => "Manager",
                "email" => "manager@larapost.local",
                "password" => Hash::make("11223344"),
            ],
            [
                "name" => "Poster",
                "email" => "poster@larapost.local",
                "password" => Hash::make("11223344"),
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}

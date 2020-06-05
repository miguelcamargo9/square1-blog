<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => "Miguel Camargo",
            'email' => "miguelcamargo9@gmail.com",
            'nickname' => "miguelcamargo9",
            'password' => Hash::make("admin123"),
        ]);
    }
}

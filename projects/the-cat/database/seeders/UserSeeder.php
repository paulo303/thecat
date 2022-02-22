<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
        User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@email.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ySS&&qdzo#Ok'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}

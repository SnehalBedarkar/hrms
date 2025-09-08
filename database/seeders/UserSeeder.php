<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Shubham',
                'last_name' => 'Bedarkar',
                'email' => 'shubham@gmail.com',
                'password' => 'shubham@123',
                'mobile_number' => '9876543210'
            ],
            [
                'first_name' => 'Priyanka',
                'last_name' => 'Bedarkar',
                'email' => 'priaynka@gmail.com',
                'password' => 'priyanka@123',
                'mobile_number' => '9876543211'
            ]
        ];


        foreach ($users as $user) {
            $user = User::create($user);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = [
            [
                'name' => 'John Doe',
                'user' => 'john',
                'password' => Hash::make('john123'),
                'role' => 'user'
            ],
            [
                'name' => 'Admin',
                'user' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin'
            ]
        ];

        User::insert($user);
    }
}

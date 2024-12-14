<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::query()->get();
        if ($users->count() <= 0) {
            $user = [
                [
                    'first_name' => 'Super',
                    'middle_name' => '',
                    'last_name' => 'Admin',
                    'username' => 'admin',
                    'user_type' => 'admin',
                    'email' => 'superadmin@gmail.com',
                    'password' => Hash::make(123456),
                    'is_real' => 0,
                ],
                [
                    'first_name' => 'John ',
                    'middle_name' => 'Alexander ',
                    'last_name' => 'Smith',
                    'username' => 'london',
                    'user_type' => 'partner',
                    'email' => 'london@gmail.com',
                    'password' => Hash::make(123456),
                    'is_real' => 0,
                ],
                [
                    'first_name' => 'John',
                    'middle_name' => ' ',
                    'last_name' => 'Doe',
                    'username' => 'customer',
                    'user_type' => 'customer',
                    'email' => 'customer@gmail.com',
                    'password' => Hash::make(123456),
                    'is_real' => 0,
                ],
            ];

            User::query()->insert($user);
        }

    }
}

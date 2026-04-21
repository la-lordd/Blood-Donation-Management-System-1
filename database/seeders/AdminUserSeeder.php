<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@bloodbank.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'Regular User',
            'email'    => 'user@bloodbank.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);
    }
}
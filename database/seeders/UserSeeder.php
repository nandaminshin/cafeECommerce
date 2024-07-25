<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'), // Make sure to hash the password
            'phone' => '09781494099',
            'address' => 'Monywa',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // User::created([
        //     'name' => 'Normal User',
        //     'email' => 'user1@gmail.com',
        //     'password' => Hash::make('password'), // Make sure to hash the password
        //     'phone' => '09123456789',
        //     'address' => 'Yangon',
        //     'role' => 'user',
        //     'created_at' => now(),
        //     'updated_at' => now(),
        // ]);
    }
}

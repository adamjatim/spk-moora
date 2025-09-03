<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
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
        // Data users
        $users = [
            [
                'name' => 'Administrator',
                'email' => 'admin@spkmoora.com',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User Demo',
                'email' => 'user@spkmoora.com',
                'role' => 'user',
                'password' => Hash::make('user123'),
                'email_verified_at' => now(),
            ],
        ];

        // Insert data ke tabel users
        foreach ($users as $user) {
            User::create($user);
        }
    }
}

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
        //
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
            'phone' => '081234567890',
            'phone_verified_at' => now(),
            'email_verified_at' => now()
        ]);


        User::create([
            'name' => 'petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('petugas'),
            'role' => 'petugas',
            'phone' => '081234567890',
            'phone_verified_at' => now(),
            'email_verified_at' => now()
        ]);
    }
}

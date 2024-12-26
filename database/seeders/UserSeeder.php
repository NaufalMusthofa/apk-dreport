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
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'teknisi User',
            'email' => 'teknisi@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'teknisi',
        ]);

        User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@gmail.com',
            'password' => bcrypt('12345'),
            'role' => 'supervisor',
        ]);
    }
}

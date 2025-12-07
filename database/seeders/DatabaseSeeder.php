<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        User::create([
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Kandis',
            'foto' => 'x',
            'password' => 'admin123',
            'role' => 'Admin',
        ]);
        User::create([
            'username' => 'Customer',
            'email' => 'customer@gmail.com',
            'no_hp' => '081324576890',
            'alamat' => 'Jl. Rokan',
            'foto' => 'x',
            'password' => 'customer123',
            'role' => 'Customer',
        ]);
    }
}

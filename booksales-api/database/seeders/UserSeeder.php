<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

use function Symfony\Component\String\b;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk tabel users.
     */
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);

        // Customer user
        User::create([
            'name' => 'Customer',
            'email' => 'customer@example.com',
            'password' => bcrypt('customer123'),
            'role' => 'customer',
        ]);
    }
}

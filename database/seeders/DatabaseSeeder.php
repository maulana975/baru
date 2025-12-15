<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@goldticket.com',
            'password' => bcrypt('admin123'),
            'phone' => '082111111111',
            'address' => 'Admin Office, Jakarta',
            'role' => 'admin',
        ]);

        // Create demo user
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'phone' => '082123456789',
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'role' => 'user',
        ]);

        // Seed packages
        $this->call(PackageSeeder::class);
    }
}

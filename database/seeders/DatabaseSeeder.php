<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Ilham ',
            'email' => 'ilham@admin.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Test user ',
            'email' => 'user@user.com',
            'password' => Hash::make('45678912'),
            'role' => 'staff',
        ]);
        \App\Models\FlowerArrangement::factory()->create([
            'name' => 'Spring Blossom',
            'image' => 'spring_blossom.jpg',
            'type' => 'Spring Collection',
            'description' => 'A beautiful arrangement featuring seasonal spring flowers.',
            'size' => 'Medium',
            'price' => 45.99,
        ]);

        \App\Models\Customer::factory()->create([
            'name' => 'John Doe',
            'address' => '123 Main St, Anytown, USA',
            'phone' => '555-1234',
            'status' => 'regular',
        ]);

        \App\Models\Customer::factory()->create([
            'name' => 'Jane Smith',
            'address' => '456 Elm St, Othercity, USA',
            'phone' => '555-5678',
            'status' => 'non-regular',
        ]);

        \App\Models\Courier::factory()->create([
            'name' => 'Johnnn',
            'phone' => '555-1234',
        ]);

    }
}

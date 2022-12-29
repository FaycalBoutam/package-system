<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'email' => 'admin@email.com', 
            'role' => 0, 
            'password' => Hash::make('admin123')
        ]);
        \App\Models\User::factory()->create([
            'email' => 'staff@email.com', 
            'role' => 1, 
            'password' => Hash::make('staff123')
        ]);
        \App\Models\User::factory()->create([
            'email' => 'user@email.com', 
            'role' => 2, 
            'password' => Hash::make('user123')
        ]);

        \App\Models\User::factory(10)->create();
        
        \App\Models\Package::factory(50)->create();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create a default admin user for the inventory system
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@ashkanet.com',
            'password' => Hash::make('12345678'),
        ]);
        
        $this->call([
            UnitsSeeder::class,
        ]);
    }
}

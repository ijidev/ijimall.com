<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(LaratrustSeeder::class);
        
        $this->call(ProductSeeder::class);
        // $this->call(LaratrustSeeder::class);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'iheanyiukwu ikenna',
        //     'email' => 'iheanyichukwui94@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '12345678', // password
        //     // 'remember_token' => Str::random(10),
        // ]);
    }
}

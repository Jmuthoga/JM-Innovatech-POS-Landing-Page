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
        // We comment out or remove the default generic factory creation 
        // because it doesn't contain your mandatory multi-stage custom attributes.
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // This triggers your dedicated customer records sequentially
        $this->call([
            CustomerSeeder::class,
            BusinessSeeder::class,
            AdminSeeder::class,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call(CategorySeeder::class);
        $this->call(SubCategorySeeder::class);
        
        $this->call(CitiesSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(StatesSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'test',
        ]);

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => 'password',
        ]);
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\ItemList;
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
        User::factory(4)->create();
        ItemList::factory(10)->create();

        // Parkirin DEV Migration 101
        // 1. php artisan migrate
        // 2. import Wilayah_indonesia
        // 3. php artisan db:seed
        // 4. php artisan db:seed SeederAndPermissionsSeeder


        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}

<?php

namespace Database\Seeders;

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
        // memanggil seeder lain
        $this->call([
            UserSeeder::class,
            GenreSeeder::class,
            ShowSeeder::class,
            PassTypeSeeder::class,
            PassSeeder::class,
            BookingSeeder::class,
            BookingItemSeeder::class,
        ]);
    }
}

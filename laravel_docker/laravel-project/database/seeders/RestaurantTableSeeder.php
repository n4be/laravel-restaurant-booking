<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $factory = \Database\Factories\RestaurantFactory::new(); 

        Restaurant::factory()->count(10)->create();
    }
}

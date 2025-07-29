<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    public function run(): void
    {
        Meal::create(['name' => 'Butter Naan', 'price' => 150.00, 'image' => 'food 1.jpg']);
        Meal::create(['name' => 'Plant-Based Pack', 'price' => 300.00, 'image' => 'food 2.jpg']);
    }
}
<?php

namespace App\Http\Controllers;

class MealController extends Controller
{
    public function index()
    {
        $meals = [
            ['name' => 'Spicy Marinated Chicken', 'price' => 700, 'dietary' => ['High Protein'], 'image' => '/images/chicken-2.jpg'],
            ['name' => 'Vegan Coconut Lentils', 'price' => 450, 'dietary' => ['Vegan', 'Gluten-Free'], 'image' => '/images/lentils-3.jpeg'],
            ['name' => 'Chapati Combo Pack', 'price' => 350, 'dietary' => ['Vegetarian'], 'image' => '/images/chapati-3.jpeg'],
            ['name' => 'Beef Sukuma Bowl', 'price' => 550, 'dietary' => ['High Iron'], 'image' => '/images/beef-2.jpeg'],
            ['name' => 'Grilled Tilapia Fillet', 'price' => 800, 'dietary' => ['Pescatarian', 'Low Carb'], 'image' => '/images/tilapia-2.jpeg'],
            ['name' => 'Spicy Bean Stew', 'price' => 420, 'dietary' => ['Vegan'], 'image' => '/images/beans.jpeg'],
            ['name' => 'Butter Naan Pack', 'slug' => 'butter-naan', 'price' => 320, 'dietary' => ['Vegetarian'], 'image' => '/images/butter-naan.jpeg'],
            ['name' => 'Broccoli & Carrot Stir-fry', 'price' => 480, 'dietary' => ['Vegan', 'Gluten-Free'], 'image' => '/images/broccoli.jpeg'],
            ['name' => 'Ginger Chicken Soup', 'price' => 600, 'dietary' => ['High Protein', 'Low Carb'], 'image' => '/images/chicken-soup.jpeg'],
            ['name' => 'Githeri', 'price' => 500, 'dietary' => ['Vegan', 'High Fiber'], 'image' => '/images/githeri.jpeg'],
        ];
        return response()->json(['meals' => $meals]);
    }
}
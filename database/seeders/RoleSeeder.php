<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create(['name' => 'admin', 'description' => 'Administrator with full access']);
        Role::create(['name' => 'customer', 'description' => 'Regular customer with ordering access']);
        Role::create(['name' => 'delivery_person', 'description' => 'Delivery personnel with delivery access']);
    }
}
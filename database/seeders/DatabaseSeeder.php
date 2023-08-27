<?php

namespace Database\Seeders;

use App\Models\Product;
use Database\Factories\ProductFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()
            ->has(Product::factory()->count(1000))
            ->create([
                "email" => "admin@gmail.com",
                "name" => "admin",
                "password" => Hash::make(123456),
            ]);
    }
}

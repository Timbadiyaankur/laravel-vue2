<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductFactory extends Factory
{

    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sku' => $this->faker->unique()->name(),
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'style' => $this->faker->text(10),
            'color' => $this->faker->text(10),
            'size' => $this->faker->text(10),
            'price' => $this->faker->randomFloat(2, 0, 10000),
        ];
    }
}

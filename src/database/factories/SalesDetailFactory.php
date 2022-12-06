<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Sales;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesDetail>
 */
class SalesDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'sales_id' => Sales::all('id')->random(),
            'product_id' => Product::all('id')->random(),
            'price' => $this->faker->numberBetween(10000, 50000),
            'qty' => $this->faker->numberBetween(1, 10)
        ];
    }
}

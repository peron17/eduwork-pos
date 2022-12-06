<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->domainWord(),
            'barcode' => $this->faker->isbn10(),
            'price' => $this->faker->numberBetween(10000, 50000),
            'information' => $this->faker->paragraph(),
            'category_id' => Category::all('id')->random(),
            'unit_id' => Unit::all('id')->random(),
            'photo' => $this->faker->imageUrl(),
            'stock' => 0,
            'is_active' => 1,
            'created_by' => User::all('id')->random(),
            'updated_by' => User::all('id')->random()
        ];
    }

    public function inactive()
    {
        return $this->state(fn () => ['is_active' => 0]);
    }
}

<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sales>
 */
class SalesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'number' => $this->faker->isbn10(),
            'date' => Carbon::now()->subDays(rand(1, 20))->format('Y-m-d H:i:s'),
            'customer_id' => Customer::all('id')->random(),
            'information' => $this->faker->paragraph(),
            'sub_total' => $this->faker->numberBetween(100000, 1000000),
            'discount' => $this->faker->randomElement([0, 5, 10]),
            'grand_total' => function ($attribute) {
                return round($attribute['sub_total'] * $attribute['discount'] / 100);
            },
            'payment_method_id' => PaymentMethod::all('id')->random(),
            'created_by' => User::all('id')->random(),
            'updated_by' => User::all('id')->random()
        ];
    }
}

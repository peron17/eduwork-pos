<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'account_number' => $this->faker->creditCardNumber(),
            'account_name' => $this->faker->name(),
            'is_active' => 1
        ];
    }

    public function inactive()
    {
        return $this->state(fn () => ['is_active' => 0]);
    }
}

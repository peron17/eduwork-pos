<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(Transaction::TRAN_TYPE),
            'date' => Carbon::now()->subMonth()->format('Y-m-d'),
            'information' => $this->faker->paragraph(),
            'supplier_id' => Supplier::all('id')->random(),
            'grand_total' => $this->faker->numberBetween(1000000, 10000000),
            'created_by' => User::all('id')->random(),
            'updated_by' => User::all('id')->random()
        ];
    }

    public function stockIn()
    {
        return $this->state([
            'type' => Transaction::TRAN_IN
        ]);
    }

    public function stockOut()
    {
        return $this->state([
            'type' => Transaction::TRAN_OUT
        ]);
    }
}

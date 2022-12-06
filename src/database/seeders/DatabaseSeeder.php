<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\PaymentMethod::factory(5)->create();

        \App\Models\Customer::factory(10)->create();

        \App\Models\Supplier::factory(5)->create();

        \App\Models\Unit::factory(5)->create()->each(function (\App\Models\Unit $unit) {
            \App\Models\Category::factory(2)->create()->each(function (\App\Models\Category $category) use ($unit) {
                $tranIn = \App\Models\Transaction::factory()->stockIn()->create();
                $tranOut = \App\Models\Transaction::factory()->stockOut()->create();
                $sales = \App\Models\Sales::factory()->create();

                \App\Models\Product::factory(4)->state([
                    'category_id' =>  $category->id,
                    'unit_id'  => $unit->id
                ])->create()->each(function (\App\Models\Product $product) use ($tranIn, $tranOut, $sales) {
                    $stockIn = \App\Models\TransactionDetail::factory()->state(function () use ($product, $tranIn) {
                        return [
                            'transaction_id' => $tranIn->id,
                            'product_id' => $product->id,
                            'qty' => 100
                        ];
                    })->create();

                    $stock = $stockIn->qty;

                    $stockOut = \App\Models\TransactionDetail::factory()->state(function () use ($product, $tranOut) {
                        return [
                            'transaction_id' => $tranOut->id,
                            'product_id' => $product->id
                        ];
                    })->create();
                    $stock -= $stockOut->qty;

                    $salesDetail = \App\Models\SalesDetail::factory()->state(function () use ($product, $sales) {
                        return [
                            'sales_id' => $sales->id,
                            'product_id' => $product->id,
                            'price' => $product->price
                        ];
                    })->create();
                    $stock -= $salesDetail->qty;

                    $product->stock = $stock;
                    $product->save();
                });
            });
        });
    }
}

<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date')->default(Carbon::now());
            $table->unsignedBigInteger('customer_id');
            $table->text('information')->nullable();
            $table->decimal('sub_total', 11, 0);
            $table->decimal('discount', 3, 0)->nullable();
            $table->decimal('grand_total', 11, 0);
            $table->unsignedBigInteger('payment_method_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('created_by', 'fk_sales_users_c')->references('id')->on('users')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('updated_by', 'fk_sales_users_u')->references('id')->on('users')->onDelete('restrict')->onUpdate('no action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};

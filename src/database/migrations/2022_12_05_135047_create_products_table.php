<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 140);
            $table->string('barcode', 80)->unique()->nullable();
            $table->decimal('price');
            $table->text('information')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('unit_id');
            $table->string('photo', 100)->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->tinyInteger('is_active')->default(1);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('category_id', 'fk_products_categories')->references('id')->on('categories')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('unit_id', 'fk_products_units')->references('id')->on('units')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('created_by', 'fk_products_users_c')->references('id')->on('users')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('updated_by', 'fk_products_users_u')->references('id')->on('users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('products');
    }
};

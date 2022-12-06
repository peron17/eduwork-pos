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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->enum('type', [
                'in',
                'out'
            ]);
            $table->date('date')->default(Carbon::now());
            $table->text('information')->nullable();
            $table->unsignedBigInteger('supplier_id');
            $table->decimal('grand_total', 11, 0)->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('created_by', 'fk_transactions_users_c')->references('id')->on('users')->onDelete('restrict')->onUpdate('no action');
            $table->foreign('updated_by', 'fk_transactions_users_u')->references('id')->on('users')->onDelete('restrict')->onUpdate('no action');
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
        Schema::dropIfExists('transactions');
    }
};

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->string('phone')->nullable();
            $table->foreignId('shipping_id')->nullable()->references('id')->on('shipping_addresses');
            $table->string('shipping_address_details')->nullable();
            $table->foreignId('payment_type_id')->nullable()->references('id')->on('payment_types');
            $table->string('invoice_no')->unique()->nullable();
            $table->integer('sub_total_price')->nullable();
            $table->integer('shipping_cost')->nullable();
            $table->integer('discount_price')->nullable();
            $table->integer('amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('currency')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

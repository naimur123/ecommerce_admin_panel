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
            $table->foreignId('shipping_id')->nullable()->references('id')->on('shipping_addresses');
            $table->foreignId('payment_type_id')->nullable()->references('id')->on('payment_types');
            $table->integer('total_price')->nullable();
            $table->integer('sub_total_price')->nullable();
            $table->integer('shipping_cost')->nullable();
            $table->integer('discount_price')->nullable();
            $table->foreignId('status_id')->nullable()->references('id')->on('generic_statuses');
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
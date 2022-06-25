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
            $table->id('id')->from(10101);
            $table->foreignId('category_id')->references('id')->on('categories')->nullable();
            $table->foreignId('subcategory_id')->references('id')->on('sub_categories')->nullable();
            $table->foreignId('brand_id')->references('id')->on('brands')->nullable();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('code');
            $table->string('quantity')->nullable();
            $table->foreignId('unit_id')->references('id')->on('units')->nullable();
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->float('price');
            $table->float('discount_price')->nullable();
            $table->float('discount_percentage')->nullable();
            $table->foreignId('currency_id')->references('id')->on('currencies')->nullable();
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->foreignId('status_id')->references('id')->on('generic_statuses')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('products');
    }
};

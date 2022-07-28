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
            $table->foreignId('category_id')->nullable()->references('id')->on('categories');
            $table->foreignId('subcategory_id')->nullable()->references('id')->on('sub_categories');
            $table->foreignId('brand_id')->nullable()->references('id')->on('brands');
            $table->string('name');
            $table->string('slug')->nullable();
            $table->string('code');
            $table->string('quantity')->nullable();
            $table->foreignId('unit_id')->nullable()->references('id')->on('units');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->float('price');
            $table->float('discount_price')->nullable();
            $table->float('discount_percentage')->nullable();
            $table->foreignId('currency_id')->nullable()->references('id')->on('currencies');
            $table->string('image_one')->nullable();
            $table->string('image_two')->nullable();
            $table->string('image_three')->nullable();
            $table->foreignId('status_id')->nullable()->references('id')->on('generic_statuses');
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

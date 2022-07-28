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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id('id');
            $table->string('name');
            $table->string('short_name')->nullable();
            $table->text('remarks')->nullable();
            $table->foreignId('country_id')->nullable()->references('id')->on('countries');
            $table->string('currency_symbol')->nullable();
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
        Schema::dropIfExists('currencies');
    }
};

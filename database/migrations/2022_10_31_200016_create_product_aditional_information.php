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
        Schema::create('product_aditional_information', function (Blueprint $table) {
            $table->id();
            $table->string('pvp')->nullable();
            $table->string('description')->nullable();
            $table->string('discount')->nullable();
            $table->foreignId('store_id')->references('id')->on('stores')->onDelete("cascade");
            $table->foreignId('product_id')->references('id')->on('products')->onDelete("cascade");
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
        Schema::dropIfExists('product_aditional_information');
    }
};

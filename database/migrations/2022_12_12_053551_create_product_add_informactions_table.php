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
        Schema::create('product_add_informactions', function (Blueprint $table) {
            $table->id();
            $table->string('sku_redvital');
            $table->string('description')->nullable();
            $table->string('code');
            $table->boolean('status')->default(false);
            $table->string('sale_price')->nullable();
            $table->string('iv');
            $table->string('catalogue')->nullable();
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->foreignId('sub_brand')->references('id')->on('sub_brands');
            $table->foreignId('line_id')->references('id')->on('lines');
            $table->foreignId('product_id')->references('id')->on('products');
            $table->string('u_m')->nullable();
            $table->string('base')->nullable(); 
            $table->string('desc')->nullable();
        

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
        Schema::dropIfExists('product_add_informactions');
    }
};

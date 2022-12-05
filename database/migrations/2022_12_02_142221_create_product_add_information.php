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
        Schema::create('product_add_information', function (Blueprint $table) {
            $table->id();
            $table->string('sku_redvital')->nullable();
            $table->longText('description')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->nullable();
            $table->float('sale_price', 9, 3)->nullable();
            $table->string('iv')->nullable();
            $table->string('catalogue')->nullable();
            $table->foreignId('brand')->nullable()->references('id')->on('brands')->onDelete("cascade");
            $table->foreignId('sub_brand')->nullable()->references('id')->on('sub_brands')->onDelete("cascade");
            $table->string('u_m')->nullable();
            $table->string('base')->nullable();
            $table->longText('desc')->nullable();
            $table->foreignId('line')->nullable()->references('id')->on('lines')->onDelete("cascade");
            $table->string('sub_category')->nullable();
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
        Schema::dropIfExists('product_add_information');
    }
};

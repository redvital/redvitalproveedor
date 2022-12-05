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
            $table->string('name');
            $table->foreignId('category')->references('id')->on('categories');
            $table->string('sku_provider');
            $table->string('bar_code')->nullable();
            $table->string('image')->nullable();
            $table->string('method_of_payment')->references('id')->on('special_forms_of_payments');
            $table->string('condition')->references('id')->on('conditions');
            $table->string('currency')->references('id')->on('coins');
            $table->integer('units')->nullable();
            $table->float('cost_per_unit', 9, 3);
            $table->float('cost_per_package', 9, 3);
            $table->float('sugessted_price', 9, 3);
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

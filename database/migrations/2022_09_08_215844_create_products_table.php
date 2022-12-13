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
            $table->string('sku_provider');
            $table->foreignId('category')->references('id')->on('categories');
            $table->string('bar_code')->nullable();
            $table->string('drive_unit')->nullable();
            $table->string('payment_condition')->nullable();
            $table->string('currency')->references('id')->on('coins');
            $table->string('pack_quantity')->nullable();
            $table->float('cost_per_package', 9, 3);
            $table->integer('discount')->nullable();
            $table->string('cost_per_unit')->nullable();
            $table->string('sugessted_price')->nullable();
            $table->string('method_of_payment')->references('id')->on('special_forms_of_payments');
            $table->string('condition')->references('id')->on('conditions');
            $table->string('image')->nullable();
            $table->boolean('approved')->default(false);
            $table->integer('units')->nullable();
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

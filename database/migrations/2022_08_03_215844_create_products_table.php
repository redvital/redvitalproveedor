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
            $table->string('sku_provider');
            $table->string('sku_redvital')->nullable();
            $table->string('name');
            $table->foreignId('category')->references('id')->on('categories');
            $table->string('condition');
            $table->longText('description')->nullable();
            $table->string('bar_code')->nullable();
            $table->string('image')->nullable();
            $table->string('status');
            $table->string('type_of_currency');
            $table->float('cost_per_unit', 9, 3);
            $table->float('cost_per_package', 9, 3);
            $table->float('sale_price', 9, 3);
            $table->integer('units');
            $table->timestamps();
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('user_id')->references('id')
            ->on('users');
            $table->foreignId('agreement_id')->references('id')
            ->on('type_agreements');
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

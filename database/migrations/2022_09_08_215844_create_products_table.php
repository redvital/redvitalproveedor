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
            $table->longText('description')->nullable();
            $table->string('code')->nullable();
            $table->string('condition');
            $table->string('bar_code')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->nullable();
            $table->string('currency');
            $table->string('method_of_payment');
            $table->float('cost_per_unit', 9, 3);
            $table->float('cost_per_package', 9, 3);
            $table->float('sale_price', 9, 3)->nullable();
            $table->float('sugessted_price', 9, 3);
            $table->integer('units')->nullable();
            $table->string('iv')->nullable();
            $table->string('catalogue')->nullable();
            $table->foreignId('brand')->nullable()->references('id')->on('brands')->onDelete("cascade");
            $table->foreignId('sub_brand')->nullable()->references('id')->on('sub_brands')->onDelete("cascade");
            $table->string('u_m')->nullable();
            $table->string('base')->nullable();
            $table->longText('desc')->nullable();
            $table->foreignId('line')->nullable()->references('id')->on('lines')->onDelete("cascade");
            $table->longText('description1')->nullable();
            $table->foreignId('category')->references('id')->on('categories');
            $table->longText('description2')->nullable();
            $table->string('sub_category')->nullable();
            $table->longText('description3')->nullable();
            $table->timestamps();
            $table->foreignId('team_id')->nullable()->references('id')->on('teams');
            $table->foreignId('user_id')->nullable()->references('id')->on('users');
            $table->foreignId('agreement_id')->nullable()->references('id')->on('type_agreements');
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

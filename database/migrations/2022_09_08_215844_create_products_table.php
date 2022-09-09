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
            $table->string('code');
            $table->string('condition');
            $table->string('bar_code')->nullable();
            $table->string('image')->nullable();
            $table->string('status');
            $table->string('type_of_currency');
            $table->float('cost_per_unit', 9, 3);
            $table->float('cost_per_package', 9, 3);
            $table->float('sale_price', 9, 3);
            $table->integer('units');
            $table->string('iv');
            $table->string('catalogue');
            $table->foreignId('brand')->references('id')->on('brands')->onDelete("cascade");
            $table->foreignId('sub_brand')->references('id')->on('sub_brands')->onDelete("cascade");
            $table->string('u_m');
            $table->string('base');
            $table->longText('desc')->nullable();
            $table->string('pvp_t01');
            $table->longText('desc01')->nullable();
            $table->string('pvp_t02');
            $table->longText('desc02')->nullable();
            $table->string('pvp_t03');
            $table->longText('desc03')->nullable();
            $table->string('pvp_t04');
            $table->longText('desc04')->nullable();
            $table->string('pvp_t05');
            $table->longText('desc05')->nullable();
            $table->string('pvp_t06');
            $table->longText('desc06')->nullable();
            $table->string('pvp_t07');
            $table->longText('desc07')->nullable();
            $table->string('pvp_t08');
            $table->longText('desc08')->nullable();
            $table->string('pvp_t09');
            $table->longText('desc09')->nullable();
            $table->string('pvp_t27');
            $table->longText('desc27')->nullable();
            $table->foreignId('line')->references('id')->on('lines')->onDelete("cascade");
            $table->longText('description1')->nullable();
            $table->foreignId('category')->references('id')->on('categories');
            $table->longText('description2')->nullable();
            $table->string('sub_category');
            $table->longText('description3')->nullable();
            $table->timestamps();
            $table->foreignId('team_id')->references('id')->on('teams');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('agreement_id')->references('id')->on('type_agreements');
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

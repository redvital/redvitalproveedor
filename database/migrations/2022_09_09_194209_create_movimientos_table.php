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
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('sku_provee')->references('id')->on('products')->onDelete("cascade");
            $table->string('condition');
            $table->string('currency');
            $table->integer('amount');
            $table->double('qpackage',8,2);
            $table->double('qunit',8,2);
            $table->double('sprice',8,2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moves');
    }
};

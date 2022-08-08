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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->longText('commercial_register')->nullable();
            $table->longText('name');
            $table->text('dni')->nullable();
            $table->longText('rif')->nullable();
            $table->longText('price_list')->nullable();
            $table->timestamps();
            $table->foreignId('category_id')->references('id')
            ->on('categories');
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
        Schema::dropIfExists('providers');
    }
};

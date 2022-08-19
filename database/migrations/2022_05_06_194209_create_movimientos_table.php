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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sku_provee')->unsigned();
            $table->string('condicion');
            $table->string('moneda');
            $table->integer('cantidad');
            $table->double('cbulto',8,2);
            $table->double('cunidad',8,2);
            $table->double('psugerido',8,2);
            $table->foreignId('sku_provee')->references('sku_provee')->on('productos')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movimientos');
    }
};

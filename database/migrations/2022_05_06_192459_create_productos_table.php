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
            $table->timestamps();
            $table->string('sku_provee');
            $table->string('sku_redvital')->nullable();
            $table->longText('nombre');
            $table->string('barras');
            $table->string('imagen')->nullable();
            $table->string('status');
            $table->foreignId('team_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->integer('cantidad_empaque');
            $table->string('condicion');
            $table->string('moneda');
            $table->string('categoria');
            $table->integer('cantidad');
            $table->double('cbulto',8,2);
            $table->double('cunidad',8,2);
            $table->double('psugerido',8,2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
};

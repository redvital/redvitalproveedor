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
        Schema::create('data_proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('id_proveedor')->references('id')->on('teams')->onDelete("cascade");
            $table->string('rif');
            $table->string('Telefono');
            $table->string('Dirección');
            $table->timestamp('email_verified_at')->nullable();

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
        Schema::dropIfExists('data_proveedores');
    }
};

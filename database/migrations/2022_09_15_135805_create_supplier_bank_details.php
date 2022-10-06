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
        Schema::create('supplier_bank_details', function (Blueprint $table) {
            $table->id();
            $table->enum('bank', ['Mercantil','Banesco','Western Union']);
            $table->enum('currency', ['BS','USD','EU']);
            $table->string('method_of_payment');
            $table->string('account_type');
            $table->string('account_number');
            $table->string('account_holder');
            $table->string('rif');
            $table->text('observations')->nullable();
            $table->foreignId('supplier_id')->references('id')->on('providers')->onDelete("cascade");
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
        Schema::dropIfExists('supplier_bank_details');
    }
};

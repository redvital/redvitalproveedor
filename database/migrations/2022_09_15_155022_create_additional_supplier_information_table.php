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
        Schema::create('additional_supplier_information', function (Blueprint $table) {
            $table->id();
            $table->string('fiscal_address');
            $table->string('state');
            $table->string('postal_code');
            $table->string('web_page')->nullable();
            $table->string('commercial_name');
            $table->string('payment_condition');
            $table->boolean('retention');
            $table->boolean('consignment');
            $table->foreignId('representative_id')->constrained('representatives');
            $table->foreignId('supplier_id')->constrained('providers');
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
        Schema::dropIfExists('additional_supplier_information');
    }
};

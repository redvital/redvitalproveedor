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
            $table->enum('state',['Amazonas', 'Anzoátegui', 'Apure', 'Aragua', 'Barinas', 'Bolívar', 'Carabobo', 'Cojedes', 'Delta Amacuro', 'Dependencias Federales', 'Distrito Federal', 'Falcón', 'Guárico', 'Lara', 'Mérida', 'Miranda','Monagas','Nueva Esparta', 'Portuguesa', 'Sucre', 'Táchira', 'Trujillo', 'Vargas','Yaracuy','Zulia']);
            $table->string('postal_code');
            $table->string('web_page')->nullable();
            $table->string('commercial_name');
            $table->enum('payment_condition', [1,2,3,4,5]);
            $table->boolean('retention');
            $table->boolean('consignment');
            $table->foreignId('representative_id')->nullable()->constrained('representatives')->default(null);
            $table->foreignId('supplier_id')->constrained('providers');
            $table->string('rif')->nullable();
            $table->string('commercial_register')->nullable();
            $table->string('identification_document')->nullable();
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_types', function (Blueprint $table) {
            $table->increments('id');
            //$table->enum('document_type', ["CC", "CE", "RC", "PS", "NIT", "TI"]);
            /* 
                1: Cédula de Ciudadanía.
                2: Cédula de Extranjería.
                3: Registro civil de nacimiento
                4: Pasaporte
                5: NIT para personas jurídicas.
                6: Tarjeta de identidad
            */
            $table->string('name');
            $table->string('abbreviation');
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
        Schema::dropIfExists('document_types');
    }
}

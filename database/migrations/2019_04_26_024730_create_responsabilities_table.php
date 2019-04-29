<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResponsabilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('responsabilities', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('t_responsible', ["T1", "T2"]); // 1: Tecnico Responsable I, 2: Tecnico responsable II
            //Foreigns
            $table->integer('forest_unit_id')->unsigned();
            $table->foreign('forest_unit_id')->references('id')->on('forest_units');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('responsabilities');
    }
}

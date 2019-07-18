<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefaultActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('measuring_unit')->nullable();

            //Foreigns
            $table->integer('activity_type_id')->unsigned();
            $table->foreign('activity_type_id')->references('id')->on('activity_types');
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
        Schema::dropIfExists('default_activities');
    }
}

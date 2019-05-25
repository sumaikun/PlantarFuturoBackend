<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrecipitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('precipitations', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('report_date');
            $table->enum('type', ["Llovizna", "Lluvia", "Lluvia Torrencial", "Tormenta"])->nullable(); //1-Llovizna, 2-Lluvia, 3-Lluvia Torrencial, 4-Tormenta
            $table->integer('hours')->nullable();
            $table->time('start')->nullable();
            $table->time('finish')->nullable();
            $table->longText('observations')->nullable();
            $table->enum('level', ["1", "2", "3", "4", "5"])->nullable();
            //Foreigns
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('precipitations');
    }
}

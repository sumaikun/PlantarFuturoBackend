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
            $table->char('code', 10);
            $table->dateTime('report_date');
            $table->enum('type', ["Llovizna", "Lluvia", "Lluvia Torrencial", "Tormenta"])->nullable(); //1-Llovizna, 2-Lluvia, 3-Lluvia Torrencial, 4-Tormenta
            $table->integer('mm_hours')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('finish')->nullable();
            $table->tinyInteger('level')->nullable();
            $table->string('responsible_name')->nullable();
            $table->string('responsible_id')->nullable();
            $table->longText('observations')->nullable();
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

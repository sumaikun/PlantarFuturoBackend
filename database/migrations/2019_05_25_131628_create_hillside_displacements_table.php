<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHillsideDisplacementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hillside_displacements', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 10);
            $table->float('longitude')->nullable();
            $table->float('width')->nullable();
            $table->string('rift')->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('hillside_displacements');
    }
}

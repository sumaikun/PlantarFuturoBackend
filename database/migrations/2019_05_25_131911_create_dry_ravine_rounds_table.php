<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDryRavineRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dry_ravine_rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 10);
            $table->dateTime('report_date');
            $table->enum('waterdam', ["Si", "No"])->nullable();
            $table->string('wd_location')->nullable();
            $table->longText('wd_description')->nullable();
            $table->enum('materialdrag', ["Si", "No"])->nullable();
            $table->string('md_location')->nullable();
            $table->longText('md_description')->nullable();
            $table->enum('noises', ["Si", "No"])->nullable();
            $table->string('ns_location')->nullable();
            $table->longText('ns_description')->nullable();
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
        Schema::dropIfExists('dry_ravine_rounds');
    }
}

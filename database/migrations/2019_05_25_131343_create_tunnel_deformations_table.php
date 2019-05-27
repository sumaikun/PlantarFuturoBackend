<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTunnelDeformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tunnel_deformations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 10);
            $table->dateTime('report_date');
            $table->float('longitude')->nullable();
            $table->float('width')->nullable();
            $table->enum('new', ["Nueva", "Existente"])->nullable();
            $table->string('location')->nullable();
            $table->longText('description')->nullable();
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
        Schema::dropIfExists('tunnel_deformations');
    }
}

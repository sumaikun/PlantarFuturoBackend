<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolAsignationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tool_asignations', function (Blueprint $table) {
            $table->increments('id');
            $table->char('state', 1)->nullable(); //1: Recibido, 2: Pendiente
            $table->date('checkin')->nullable();
            $table->date('checkout')->nullable();
            $table->longText('transfer_notes')->nullable();
            $table->longText('evidence_photo')->nullable();

            //Foreigns
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
            $table->integer('tool_id')->unsigned();
            $table->foreign('tool_id')->references('id')->on('tools');
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
        Schema::dropIfExists('tool_asignations');
    }
}

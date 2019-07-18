<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->increments('id');
            $table->boolean('assistance')->default(0);
            $table->string('checkin')->nullable();
            $table->string('checkout')->nullable();
            $table->string('reason')->nullable();
            $table->longText('notes')->nullable();
            //Foreigns
            $table->integer('contractor_id')->unsigned();
            $table->foreign('contractor_id')->references('id')->on('contractors');
            $table->integer('sst_report_id')->unsigned();
            $table->foreign('sst_report_id')->references('id')->on('sst_reports');
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
        Schema::dropIfExists('assistants');
    }
}

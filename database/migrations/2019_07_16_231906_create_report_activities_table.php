<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('hours')->nullable();
            $table->smallInteger('quantity')->nullable();

            //Foreigns
            $table->integer('default_activity_id')->unsigned();
            $table->foreign('default_activity_id')->references('id')->on('default_activities');
            $table->integer('daily_report_id')->unsigned();
            $table->foreign('daily_report_id')->references('id')->on('daily_reports');
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
        Schema::dropIfExists('report_activities');
    }
}

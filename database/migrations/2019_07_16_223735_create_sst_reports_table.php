<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSSTReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sst_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('report_date')->nullable();
            $table->string('location')->nullable();
            $table->longText('goal')->nullable();
            $table->string('responsible')->nullable();
            $table->longText('notes')->nullable();
            $table->longText('progress_img1')->nullable();
            $table->longText('progress_img2')->nullable();
            $table->longText('progress_img3')->nullable();
            $table->longText('progress_img4')->nullable();

            //Foreigns
            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')->references('id')->on('projects');
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
        Schema::dropIfExists('sst_reports');
    }
}

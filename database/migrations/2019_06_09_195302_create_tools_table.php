<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->increments('id');
            $table->char('code', 10)->nullable();
            $table->string('name')->nullable();
            $table->longText('description')->nullable();
            $table->char('type', 1)->nullable();
            $table->string('model')->nullable();
            $table->string('customer')->nullable();
            $table->string('workfront')->nullable();
            $table->enum('condition', ['Buena', 'Media', 'Mala'])->nullable();
            $table->string('provider')->nullable();
            $table->string('remaining_service')->nullable();
            $table->date('buy_date')->nullable();
            $table->float('price')->nullable();
            //Foreigns
            $table->integer('tool_category_id')->unsigned();
            $table->foreign('tool_category_id')->references('id')->on('tool_categories');
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
        Schema::dropIfExists('tools');
    }
}

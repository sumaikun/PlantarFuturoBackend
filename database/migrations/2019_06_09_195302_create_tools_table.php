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
            $table->char('code', 10);
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('type');
            $table->string('model');
            $table->integer('quantity');
            $table->string('customer');
            $table->enum('condition', ['Buena', 'Media', 'Mala']);
            $table->string('provider');
            $table->string('remaining_service');
            $table->date('buy_date')->nullable();
            $table->float('price')->nullable();
            $table->longText('notes')->nullable();
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

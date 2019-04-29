<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForestUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forest_units', function (Blueprint $table) {
            $table->increments('id');
            $table->string('inspector');
            $table->char('code', 10);
            $table->string('common_name');
            $table->string('scientific_name')->nullable();
            $table->string('species')->nullable();
            $table->string('family')->nullable();
            $table->float('cap_cm');
            $table->float('total_heigth_m');
            $table->float('commercial_heigth_m');
            $table->float('cup_diameter_m');
            $table->string('north_coord');
            $table->string('east_coord');
            $table->enum('condition', ["Malo", "Regular", "Bueno"]);                // 1: Malo, 2: Regular, 3: Bueno
            $table->enum('health_status', ["Malo", "Regular", "Bueno"]);            // 1: Malo, 2: Regular, 3: Bueno
            $table->enum('origin', ["Nativa", "Exotica"]);                          // 1: Nativa, 2: Exotica
            $table->enum('cup_density', ["Clara", "Media", "Espesa"]);              // 1: Clara, 2: Media, 3: Espesa
            $table->enum('products', ["Leña", "Madera"]);                           // 1: Leña, 2: Madera
            $table->enum('margin', ["Derecha", "Izquierda"]);                       // 1: Derecha, 2: Izquierda
            $table->enum('treatment', ["Tala", "Perman. Y/poda", "Bloque y T."]);   // 1: Tala, 2: Perman. Y/poda, 3: Bloque y T.
            $table->enum('state', ["Talado", "No Talado"]);                         // 1: Talado, 2: No Talado
            $table->string('resolution')->nullable();
            $table->string('general_image')->nullable();
            $table->string('before_image')->nullable();
            $table->string('after_image')->nullable();
            $table->date('start_treatment');
            $table->date('end_treatment');
            $table->longText('note');
            //Foreigns
            $table->integer('functional_unit_id')->unsigned();
            $table->foreign('functional_unit_id')->references('id')->on('functional_units');
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
        Schema::dropIfExists('forest_units');
    }
}

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
            $table->char('code', 10); // (1R)
            $table->string('common_name'); // (1R)
            $table->string('scientific_name')->nullable(); // Final optional field (1N)
            $table->string('species')->nullable(); // Final optional field (2N)
            $table->string('family')->nullable(); // Final optional field (2N)
            $table->float('cap_cm')->nullable(); // (3R)
            $table->float('total_heigth_m')->nullable(); // (3R)
            $table->float('commercial_heigth_m')->nullable(); // (3R)
            $table->float('x_cup_diameter_m')->nullable(); // (3R)
            $table->float('y_cup_diameter_m')->nullable(); // (3R)
            $table->string('north_coord')->nullable(); // (2R)
            $table->string('east_coord')->nullable(); // (2R)
            $table->enum('condition', ["Malo", "Regular", "Bueno"])->nullable();                         // 1: Malo, 2: Regular, 3: Bueno (2R)
            $table->enum('health_status', ["Malo", "Regular", "Bueno"])->nullable();                     // 1: Malo, 2: Regular, 3: Bueno (2R)
            $table->enum('origin', ["Nativa", "Exotica"])->nullable();                                   // 1: Nativa, 2: Exotica (3R)
            $table->enum('cup_density', ["Clara", "Media", "Espesa"])->nullable();                       // 1: Clara, 2: Media, 3: Espesa (3R)
            $table->enum('products', ["Leña", "Madera"])->nullable();                                    // 1: Leña, 2: Madera (4R)
            $table->enum('margin', ["Derecha", "Izquierda"])->nullable();                                // 1: Derecha, 2: Izquierda (4R)
            $table->enum('treatment', ["Tala", "Perman. Y/poda", "Bloque y T.", "Plantar"])         // 1: Tala, 2: Perman. Y/poda, 3: Bloque y T. , 4: Plantar (3R)
                ->nullable();            
            $table->enum('state',                                                                        // 1: Talado, 2: No Talado, 3: En proceso, 4: Sin Iniciar, 5: Inhabilitado, 6: Sin definir
                ["Talado", "No Talado", "En proceso", "Sin iniciar", "Inhabilitado", "Sin definir"])     // (1*) - (2R) - (3*)
                ->nullable();
            $table->string('resolution')->nullable(); // Final optional field (1N)
            $table->text('general_image')->nullable(); // Final optional field (2N)
            $table->text('before_image')->nullable(); // (3R)
            $table->text('after_image')->nullable(); // (4R)
            $table->date('start_treatment')->nullable(); // (3R)
            $table->date('end_treatment')->nullable(); // (4R)
            $table->longText('note')->nullable(); // (4N)
            $table->string('version')->nullable(); // Final optional field
            $table->string('sheet_number')->nullable(); // Final optional field
            //Foreigns
            $table->integer('functional_unit_id')->unsigned(); // (1R)
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

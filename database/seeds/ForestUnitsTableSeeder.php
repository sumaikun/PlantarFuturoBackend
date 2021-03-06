<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ForestUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forest_units')->insert([
			'code' => '309F',
			'common_name' => 'Torcazo',
			'scientific_name' => 'Schefflera morototoni',
			'family' => 'Euphorbiaceac',
			'cap_cm' => 44.0,
			'total_heigth_m' => 10.0,
			'commercial_heigth_m' => 7.0,
			'x_cup_diameter_m' => 6.0,
			'y_cup_diameter_m' => 6.0,
			'north_coord' => null,
			'east_coord' => null,
			'waypoint' => "123456789",
			'epiphytes' => "NO",
			'condition' => 'Bueno',
			'health_status' => 'Bueno',
			'origin' => 'Nativa',
			'cup_density' => 'Clara',
			'products' => 'Leña',
			'margin' => 'Derecha',
			'treatment' => 'Tala',
			'state' => 'Talado',
			'resolution' => '0366',
			'id_image' => null,
			'general_image' => null,
			'reference_image' => null,
			'after_image' => null,
			'start_treatment' => Carbon::parse('2019-04-25'),
			'end_treatment' => Carbon::parse('2019-04-28'),
			'compensation_site' => 'El Tablon-Lote 10',
			'note' => 'Sin observaciones',
			'functional_unit_id' => 1,
        ]);
    }
}

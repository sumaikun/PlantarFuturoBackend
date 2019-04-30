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
			'species' => 'Alchornea sp.',
			'family' => 'Euphorbiaceac',
			'cap_cm' => 44.0,
			'total_heigth_m' => 10.0,
			'commercial_heigth_m' => 7.0,
			'cup_diameter_m' => 6.0,
			'north_coord' => '968455',
			'east_coord' => '1073797',
			'condition' => 'Bueno',
			'health_status' => 'Bueno',
			'origin' => 'Nativa',
			'cup_density' => 'Clara',
			'products' => 'Leña',
			'margin' => 'Derecha',
			'treatment' => 'Tala',
			'state' => 'Talado',
			'resolution' => '0366',
			'general_image' => null,
			'before_image' => null,
			'after_image' => null,
			'start_treatment' => Carbon::parse('2019-04-25'),
			'end_treatment' => Carbon::parse('2019-04-28'),
			'note' => 'Sin observaciones',
			'functional_unit_id' => 1,
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {    
		DB::table('species')->insert([
		    'name' => 'Mangifera indica L.',
		]);

		DB::table('species')->insert([
		    'name' => 'Cecropia peltata',
		]);

		DB::table('species')->insert([
		    'name' => 'Cedrela odorata L.',
		]);

		DB::table('species')->insert([
		    'name' => 'Swinglea glutinosa (Blanco) Merr.',
		]);

		DB::table('species')->insert([
		    'name' => 'Eugenia sp.',
		]);

		DB::table('species')->insert([
		    'name' => 'Inga spectabilis (Vahl) Willd.',
		]);

		DB::table('species')->insert([
		    'name' => 'Spathodea campanulata P.Beauv',
		]);

		DB::table('species')->insert([
		    'name' => 'Bauhinia guianensis Aubl.',
		]);

		DB::table('species')->insert([
		    'name' => 'Matisia cordata Bonpl.',
		]);

		DB::table('species')->insert([
		    'name' => 'Citrus reticulata Blanco',
		]);

		DB::table('species')->insert([
		    'name' => 'Syzygium malaccense (L.) Merr. & L.M.Perry',
		]);

		DB::table('species')->insert([
		    'name' => 'Artocarpus communis J.R. Forst. & Forst.',
		]);

		DB::table('species')->insert([
		    'name' => 'Miconia multispicata',
		]);

		DB::table('species')->insert([
		    'name' => 'Ficus donnell-smithii Standl.',
		]);

		DB::table('species')->insert([
		    'name' => 'Vismia macrophylla Kunth',
		]);

		DB::table('species')->insert([
		    'name' => 'Tapirira guianensis Aubl.',
		]);

		DB::table('species')->insert([
		    'name' => 'Alchornea sp.',
		]);

		DB::table('species')->insert([
		    'name' => 'Carapa guianensis',
		]);

		DB::table('species')->insert([
		    'name' => 'Terminalia amazonia (J.F.Gmel.) Exell',
		]);

		DB::table('species')->insert([
		    'name' => 'Erythroxylum macrophyllum Cav. cf',
		]);

		DB::table('species')->insert([
		    'name' => 'Schefflera morototonii',
		]);

		DB::table('species')->insert([
		    'name' => 'Acrocomia aculeata (Jacq.) Lodd. ex Mart.',
		]);

		DB::table('species')->insert([
		    'name' => 'Triplaris americana L.',
		]);
    }
}

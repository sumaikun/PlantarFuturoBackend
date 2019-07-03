<?php

use Illuminate\Database\Seeder;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::table('families')->insert([
		    'name' => 'Anacardiaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Urticaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Meliaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Rutaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Myrtaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Fabaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Bignoniaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Melastomataceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Hypericaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Euphorbiaceae',
		]);

		DB::table('families')->insert([
		    'name' => 'Araliaceae',
		]);
    }
}

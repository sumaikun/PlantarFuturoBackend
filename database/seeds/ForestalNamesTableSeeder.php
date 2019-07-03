<?php

use Illuminate\Database\Seeder;

class ForestalNamesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('forestal_names')->insert([
            'common_name' => 'Torcazo',
            'scientific_name' => 'Schefflera morototoni',
        ]);

        DB::table('forestal_names')->insert([
            'common_name' => 'Clusia',
            'scientific_name' => 'Clusia sp.',
        ]);
    }
}

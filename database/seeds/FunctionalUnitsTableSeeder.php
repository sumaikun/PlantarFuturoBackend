<?php

use Illuminate\Database\Seeder;

class FunctionalUnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('functional_units')->insert([
            'code' => 'UF1',
            'project_id' => 1,
        ]);

        DB::table('functional_units')->insert([
            'code' => 'UF2',
            'project_id' => 1,
        ]);

        DB::table('functional_units')->insert([
            'code' => 'UF3',
            'project_id' => 1,
        ]);

        DB::table('functional_units')->insert([
            'code' => 'UF4',
            'project_id' => 1,
        ]);
    }
}

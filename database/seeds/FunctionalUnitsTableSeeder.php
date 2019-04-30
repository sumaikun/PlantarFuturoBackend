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
            'type' => 'Licencia',
            'project_id' => 1,
        ]);

        DB::table('functional_units')->insert([
            'code' => 'UF2',
            'type' => 'Licencia',
            'project_id' => 1,
        ]);

        DB::table('functional_units')->insert([
            'code' => 'UF3',
            'type' => 'Licencia',
            'project_id' => 1,
        ]);

        DB::table('functional_units')->insert([
            'code' => 'UF4',
            'type' => 'Compensación',
            'project_id' => 1,
        ]);
    }
}

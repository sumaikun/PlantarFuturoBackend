<?php

use Illuminate\Database\Seeder;

class ResponsabilitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('responsabilities')->insert([
            'module' => 'Inventario',
            'action' => 'Crear',
            'forest_unit_id' => 1,
            'user_id' => 3,
        ]);

        DB::table('responsabilities')->insert([
            'module' => 'Aprovechamiento',
            'action' => 'Editar',
            'forest_unit_id' => 1,
            'user_id' => 4,
        ]);
    }
}

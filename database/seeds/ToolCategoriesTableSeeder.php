<?php

use Illuminate\Database\Seeder;

class ToolCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tool_categories')->insert([
            'name' => 'Maquinaria',
        ]);

        DB::table('tool_categories')->insert([
            'name' => 'Equipo',
        ]);

        DB::table('tool_categories')->insert([
            'name' => 'Vehículo',
        ]);

        DB::table('tool_categories')->insert([
            'name' => 'Tecnología',
        ]);
    }
}

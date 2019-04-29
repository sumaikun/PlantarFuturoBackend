<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'name' => 'Conexión Pacífico 1',
			'inspector' => 'Servinc - ETA',
			'responsible' => 'Jaime Prieto',
			'representative_name' => 'Fernando Alberto Baquero',
			'representative_position' => 'Representante Legal',
			'administrative_act' => 'Cormacarena- Resolución 0887',
			'enviromental_control' => 'ANLA',
			'east_coord' => '1142274',
			'north_coord' => '1155849',
			'location' => 'Tramo 4',
			'phase' => '3',
			'customer_id' => 1,
        ]);
    }
}

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
    	/*
		INSERT INTO `projects` (`id`, `name`, `inspector`, `responsible`, `representative_name`, `representative_position`, `administrative_act`, `enviromental_control`, `east_coord`, `north_coord`, `location`, `phase`, `customer_id`, `created_at`, `updated_at`) VALUES (NULL, 'Inventario Conexión Pacifico 1', 'Linda Linares', 'Linda Linares', 'Tito Garcia', 'Coordinador inventario', 'NA', 'ANLA', '1156117.93197', '1160429.0514', 'Antioquia', '1', '1', '2019-05-17 19:40:31', '2019-05-17 19:40:31');
    	

        INSERT INTO `projects` (`id`, `name`, `inspector`, `responsible`, `representative_name`, `representative_position`, `administrative_act`, `enviromental_control`, `east_coord`, `north_coord`, `location`, `phase`, `customer_id`, `created_at`, `updated_at`) VALUES (NULL, 'Inventario Amagá', 'Claudia Gomez', 'Linda Linares', 'Tito Garcia', 'Coordinador inventario', 'N/A', 'ANLA', '1152594', '1158561', 'Amagá, Antioquia', '1', '1', '2019-05-21 02:22:03', '2019-05-21 02:22:03');

        INSERT INTO `projects` (`id`, `name`, `inspector`, `responsible`, `representative_name`, `representative_position`, `administrative_act`, `enviromental_control`, `east_coord`, `north_coord`, `location`, `phase`, `customer_id`, `created_at`, `updated_at`) VALUES (NULL, 'Proyecto Prueba Inventario', 'Marlon', 'Camilo', 'Jesus', 'Representante', 'Acto', 'ANLA', '123456', '123456', 'Bogota', '1', '1', '2019-05-21 04:51:05', '2019-05-21 04:51:05');

        INSERT INTO `projects` (`id`, `name`, `inspector`, `responsible`, `representative_name`, `representative_position`, `administrative_act`, `enviromental_control`, `east_coord`, `north_coord`, `location`, `phase`, `customer_id`, `created_at`, `updated_at`) VALUES (NULL, 'Gestión de riesgos', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', 'Plantar Futuro', '4', '1', NULL, NULL)
        */
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

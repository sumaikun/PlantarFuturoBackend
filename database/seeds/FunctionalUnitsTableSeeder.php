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
        /*
        INSERT INTO `functional_units` (`id`, `code`, `type`, `project_id`, `created_at`, `updated_at`) VALUES (NULL, 'UF5', 'Compensación', '1', '2019-05-21 05:06:16', '2019-05-21 05:06:16'), (NULL, 'UF1', 'Licencia', '2', '2019-05-21 05:23:47', '2019-05-21 05:23:47'), (NULL, 'UF7', 'Licencia', '2', '2019-05-21 05:50:56', '2019-05-21 05:50:56'), (NULL, 'UF1', 'Licencia', '4', '2019-05-21 06:19:00', '2019-05-21 06:19:26'), (NULL, 'UF02', 'Licencia', '4', '2019-05-21 06:38:44', '2019-05-21 06:38:57'), (NULL, 'UF8', 'Licencia', '2', '2019-05-21 08:13:21', '2019-05-21 08:13:21'), (NULL, 'A-Alexa', 'Licencia', '3', '2019-05-21 11:46:43', '2019-05-21 11:46:43'), (NULL, 'B-Harley', 'Licencia', '3', '2019-05-21 11:47:39', '2019-05-21 11:47:39'), (NULL, 'C-Laura', 'Licencia', '3', '2019-05-21 11:48:14', '2019-05-21 11:48:14'), (NULL, 'D-Jonat', 'Licencia', '3', '2019-05-21 11:48:31', '2019-05-21 11:48:31'), (NULL, 'C-Laura2', 'Licencia', '3', '2019-05-22 07:37:29', '2019-05-22 07:37:29'), (NULL, 'C-Laura3', 'Licencia', '3', '2019-05-22 09:03:14', '2019-05-22 09:03:14')
        
        */
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

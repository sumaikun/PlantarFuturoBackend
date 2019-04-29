<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'Estadísticas Administrativas y gerenciales',
            'platform' => 'WEB',
        ]);

        DB::table('roles')->insert([
            'name' => 'Creación y edicion del proyecto',
            'platform' => 'WEB',
        ]);

        DB::table('roles')->insert([
            'name' => 'Estadísticas del proyecto',
            'platform' => 'WEB',
        ]);

        DB::table('roles')->insert([
            'name' => 'Estadísticas individuales',
            'platform' => 'WEB',
        ]);

        DB::table('roles')->insert([
            'name' => 'Creación y edición del proceso',
            'platform' => 'WEB',
        ]);

        DB::table('roles')->insert([
            'name' => 'Creación y edición del proceso',
            'platform' => 'APP',
        ]);

        DB::table('roles')->insert([
            'name' => 'Estadísticas individuales',
            'platform' => 'APP',
        ]);
    }
}

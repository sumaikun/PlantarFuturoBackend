<?php

use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('positions')->insert([
            'name' => 'Gerencia General',
        ]);

        DB::table('positions')->insert([
            'name' => 'Gerencia Administrativa',
        ]);

        DB::table('positions')->insert([
            'name' => 'Cordinaciòn De proyecto',
        ]);

        DB::table('positions')->insert([
            'name' => 'Supervisión Tecnica',
        ]);

        DB::table('positions')->insert([
            'name' => 'Ingeniero Residente',
        ]);
    }
}

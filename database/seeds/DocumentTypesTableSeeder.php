<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('document_types')->insert([
            'name' => 'Cédula de Ciudadanía',
            'abbreviation' => 'CC',
        ]);

        DB::table('document_types')->insert([
            'name' => 'Cédula de Extranjería',
            'abbreviation' => 'CE',
        ]);

        DB::table('document_types')->insert([
            'name' => 'Registro civil de nacimiento',
            'abbreviation' => 'RC',
        ]);

        DB::table('document_types')->insert([
            'name' => 'Pasaporte',
            'abbreviation' => 'PS',
        ]);

        DB::table('document_types')->insert([
            'name' => 'Número de Identificación Tributaria',
            'abbreviation' => 'NIT',
        ]);

        DB::table('document_types')->insert([
            'name' => 'Tarjeta de identidad',
            'abbreviation' => 'TI',
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'document' => '123',
            'name' => 'Marlon',
            'lastname' => 'Gamba',
            'phone' => '3144853601',
            'address' => 'Cll 1 Cra 2',
            'email' => 'marlon.gamba@gmail.com',
            'password' => bcrypt('secret'),
            'position_id' => 1,
            'document_type_id' => 1,
        ]);

        DB::table('users')->insert([
            'document' => '456',
            'name' => 'Pedro',
            'lastname' => 'Alarcon',
            'phone' => '3115258545',
            'address' => 'Cll 2 Cra 3',
            'email' => 'pedro.alarcon@gmail.com',
            'password' => bcrypt('secret'),
            'position_id' => 2,
            'document_type_id' => 1,
        ]);

        DB::table('users')->insert([
            'document' => '789',
            'name' => 'Jesus',
            'lastname' => 'Vega',
            'phone' => '3154985465',
            'address' => 'Cll 3 Cra 4',
            'email' => 'jesus.vega@gmail.com',
            'password' => bcrypt('secret'),
            'position_id' => 3,
            'document_type_id' => 1,
        ]);

        DB::table('users')->insert([
            'document' => '987',
            'name' => 'Julian',
            'lastname' => 'Bermudez',
            'phone' => '3124567858',
            'address' => 'Cll 4 Cra 5',
            'email' => 'julian.bermudez@gmail.com',
            'password' => bcrypt('secret'),
            'position_id' => 4,
            'document_type_id' => 1,
        ]);

        DB::table('users')->insert([
            'document' => '321',
            'name' => 'Camilo',
            'lastname' => 'Montoya',
            'phone' => '3141234578',
            'address' => 'Cll 5 Cra 6',
            'email' => 'camilo.montoya@gmail.com',
            'password' => bcrypt('secret'),
            'position_id' => 5,
            'document_type_id' => 1,
        ]);
    }
}

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
        /*INSERT INTO `users` (`id`, `document`, `name`, `lastname`, `phone`, `address`, `email`, `password`, `position_id`, `document_type_id`, `remember_token`, `created_at`, `updated_at`) VALUES (NULL, '2', 'Tito', 'Garcia', '123', 'Plantar futuro', 'forestito@gmail.com', '$2y$10$K6d/2x5Lx0JwYIlt1aUjQuK6SzAw4K838mPEMAV1RMg0P.uIniPeu', '3', '1', NULL, '2019-05-14 13:41:30', '2019-05-14 13:41:30'), (NULL, '3', 'Laura Carolina', 'Segura Triana', '123', 'Plantar futuro', 'lauraseguratriana@gmail.com', '$2y$10$K6d/2x5Lx0JwYIlt1aUjQuK6SzAw4K838mPEMAV1RMg0P.uIniPeu', '5', '1', NULL, '2019-05-14 13:42:09', '2019-05-14 13:42:09'), (NULL, '4', 'Dennys Alexandra', 'Prada Cruz', '123', 'Plantar futuro', 'alexandra.pradacruz@gmail.com', '$2y$10$K6d/2x5Lx0JwYIlt1aUjQuK6SzAw4K838mPEMAV1RMg0P.uIniPeu', '5', '1', NULL, '2019-05-14 13:42:43', '2019-05-14 13:42:43'), (NULL, '5', 'Jaime Harley', 'Gonzalez Cardenas', '123', 'Plantar futuro', 'harforest@gmail.com', '$2y$10$K6d/2x5Lx0JwYIlt1aUjQuK6SzAw4K838mPEMAV1RMg0P.uIniPeu', '5', '1', NULL, '2019-05-14 13:43:04', '2019-05-14 13:43:04'), (NULL, '6', 'Jonathan Eduardo', 'Arenas Cabrera', '123', 'Plantar futuro', 'jo.arenas93@gmail.com', '$2y$10$K6d/2x5Lx0JwYIlt1aUjQuK6SzAw4K838mPEMAV1RMg0P.uIniPeu', '5', '1', NULL, '2019-05-14 13:43:42', '2019-05-14 13:43:42')*/
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

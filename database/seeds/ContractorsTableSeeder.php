<?php

use Illuminate\Database\Seeder;

class ContractorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//**Jesus**//

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 2,
            'user_id' => 3,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 3,
            'user_id' => 3,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 4,
            'user_id' => 3,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 5,
            'user_id' => 3,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 6,
            'user_id' => 3,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 7,
            'user_id' => 3,
        ]);

        //**Julian**//

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 3,
            'user_id' => 4,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 4,
            'user_id' => 4,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 5,
            'user_id' => 4,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 6,
            'user_id' => 4,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 7,
            'user_id' => 4,
        ]);

        //**Camilo**//

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 4,
            'user_id' => 5,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 5,
            'user_id' => 5,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 6,
            'user_id' => 5,
        ]);

        DB::table('contractors')->insert([
            'project_id' => 1,
            'role_id' => 7,
            'user_id' => 5,
        ]);
    }
}

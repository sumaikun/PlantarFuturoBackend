<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DocumentTypesTableSeeder::class);
        $this->call(PositionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(ContractorsTableSeeder::class);
        $this->call(FunctionalUnitsTableSeeder::class);
        $this->call(ForestUnitsTableSeeder::class);
        $this->call(ResponsabilitiesTableSeeder::class);
        //$this->call(SpeciesTableSeeder::class);
        $this->call(FamiliesTableSeeder::class);
        $this->call(ForestalNamesTableSeeder::class);
    }
}

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
         $this->call(UsersTableSeeder::class);
         $this->call(ClientsTableSeeder::class);
         $this->call(RolesTableSeeder::class);
         $this->call(StakeholderTableSeeder::class);
         $this->call(CityTableSeeder::class);
         $this->call(DepartmentsTableSeeder::class);
    }
}

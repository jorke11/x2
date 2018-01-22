<?php

use Illuminate\Database\Seeder;

class CityTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("cities")->insert([
            'department_id' => 1,
            'description' => 'Bogota',
            'code' => 1000
        ]);
    }

}

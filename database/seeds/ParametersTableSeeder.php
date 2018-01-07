<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("parameters")->insert([
            'description' => "Checkbox",
            'group' => "type_form",
            'code' => 1,
        ]);
        DB::table("parameters")->insert([
            'description' => "Input",
            'group' => "type_form",
            'code' => 2,
        ]);
        DB::table("parameters")->insert([
            'description' => "TextArea",
            'group' => "type_form",
            'code' => 3,
        ]);
    }

}

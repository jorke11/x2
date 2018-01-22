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

        DB::table("parameters")->insert([
            'description' => "Natural",
            'group' => "typeperson",
            'code' => 1,
        ]);

        DB::table("parameters")->insert([
            'description' => "Juridica",
            'group' => "typeperson",
            'code' => 2,
        ]);

        DB::table("parameters")->insert([
            'description' => "Comun",
            'group' => "typeregimen",
            'code' => 1,
        ]);

        DB::table("parameters")->insert([
            'description' => "Simplificado",
            'group' => "typeregimen",
            'code' => 2,
        ]);
        DB::table("parameters")->insert([
            'description' => "Seguridad",
            'group' => "sector",
            'code' => 1,
        ]);
        
        DB::table("parameters")->insert([
            'description' => "Salud",
            'group' => "sector",
            'code' => 2,
        ]);
        
        DB::table("parameters")->insert([
            'description' => "Cedula",
            'group' => "typedocument",
            'code' => 1,
        ]);
        
        DB::table("parameters")->insert([
            'description' => "Nit",
            'group' => "typedocument",
            'code' => 2,
        ]);
        
         DB::table("parameters")->insert([
            'description' => "number",
            'group' => "type_data_input",
            'code' => 1,
        ]);
         DB::table("parameters")->insert([
            'description' => "alfa",
            'group' => "type_data_input",
            'code' => 2,
        ]);
        
    }

}

<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table("clients")->insert([
            'type_regime_id' => 1,
            'type_person_id' => 1,
            'type_stakeholder' => 1,
            'city_id' => 1,
            'status_id' => 1,
            'type_document' => 1,
            'responsible_id' => 1,
            'send_city_id' => 1,
            'invoice_city_id' => 1,
            'address_send' => 1,
            'address_invoice' => 1,
            'name' => 1,
            'last_name' => 1,
            'document' => 1,
            'verification' => 1,
            'email' => 1,
            'address' => 1,
            'phone' => 1,
            'business_name' => 1,
            'business' => 1,
            'shipping_cost' => 1,
            'password' => 1,
            'web_site' => 1,
            'user_insert' => 1,
            'user_update' => 1,
            'login_web' => 1,
        ]);
    }

}

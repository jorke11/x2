<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDinamicDetailTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('dinamics_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dinamic_id');
            $table->text('label_field');
            $table->text('name_field');
            $table->text('placeholder_field');
            $table->integer('type_form_id');
            $table->integer('type_data_id')->nullable();
            $table->integer('length_text')->nullable();
            $table->boolean('required_field')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('dinamics_detail');
    }

}

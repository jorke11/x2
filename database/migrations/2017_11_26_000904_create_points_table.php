<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePointsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('route_id');
            $table->text('name');
            $table->text('address');
            $table->text('qr')->nullable();
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->integer('uinsert');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('points');
    }

}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePairDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pair_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pair_id');
            $table->dateTime('report');
            $table->double('latitude', 15, 8);
            $table->double('longitude', 15, 8);
            $table->integer('uinsert');
            $table->text('img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('pair_detail');
    }
}


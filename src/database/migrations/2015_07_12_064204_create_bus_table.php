<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus', function (Blueprint $table) {
            $table->increments('bus_id');
            $table->double('lat');
            $table->double('lon');
            $table->integer('speed');
            $table->integer('route_id')->unsigned();
            $table->integer('bus_stop_id')->unsigned(); // Last passed bus stop 
            $table->foreign('route_id')->references('route_id')->on('route');
            $table->foreign('bus_stop_id')->references('bus_stop_id')->on('bus_stop');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bus');
    }
}

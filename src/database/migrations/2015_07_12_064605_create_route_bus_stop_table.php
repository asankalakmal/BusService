<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteBusStopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('route_bus_stop', function (Blueprint $table) {
            $table->increments('route_bus_stop_id');
            $table->integer('route_id')->unsigned();
            $table->integer('bus_stop_id')->unsigned();
            $table->integer('sequence_no');
            $table->double('distance_from_start');
            $table->foreign('bus_stop_id')->references('bus_stop_id')->on('bus_stop');
            $table->foreign('route_id')->references('route_id')->on('route');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('route_bus_stop');
    }
}

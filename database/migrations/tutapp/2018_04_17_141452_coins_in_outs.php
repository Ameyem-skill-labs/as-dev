<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CoinsInOuts extends Migration
{
    public function up()
    {
        Schema::create('coinsinouts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nature_id')->unsigned();
            $table->foreign('nature_id')->references('id')->on('natureinout');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('enrollment_id')->nullable();
            $table->float('coins');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('coinsinouts');
    }
}

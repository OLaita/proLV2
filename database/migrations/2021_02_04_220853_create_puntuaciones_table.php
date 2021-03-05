<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuntuacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntuaciones', function (Blueprint $table) {
            $table->increments('id')->unique();
		    $table->unsignedBigInteger('video_id');
		    $table->unsignedBigInteger('user');
		    $table->integer('p_num');
            $table->foreign('user')->references('id')->on('users');
            $table->foreign('video_id')->references('id')->on('videos');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puntuaciones');
    }
}

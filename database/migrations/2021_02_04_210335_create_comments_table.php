<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
		    $table->string('comment', 255);
		    $table->unsignedBigInteger('user');
		    $table->unsignedBigInteger('idVideo');

            $table->timestamps();

            $table->foreign('user')->references('id')->on('users');
            $table->foreign('idVideo')->references('id')->on('videos');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

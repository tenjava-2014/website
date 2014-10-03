<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTimesInfo extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('participant_times', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->unsignedInteger("user_id");
            $table->foreign("user_id")->references("id")->on("applications");
            // I'd much rather use 3 bits and OR them but laravel has no fixed-length BINARY equivalent
            $table->boolean("t1");
            $table->boolean("t2");
            $table->boolean("t3");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('participant_times');
    }

}

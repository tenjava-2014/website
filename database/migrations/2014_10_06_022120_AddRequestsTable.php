<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddRequestsTable extends Migration {

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('requests');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');;
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');;
        });
    }

}

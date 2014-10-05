<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddClaimsTable extends Migration {

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('claims');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('staff_id')->unsigned();
            $table->foreign('staff_id')->references('id')->on('staff');
            $table->integer('team_id')->unsigned();
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

}

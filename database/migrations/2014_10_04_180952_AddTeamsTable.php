<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddTeamsTable extends Migration {

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('teams');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->unique();
            $table->integer('claimed_by')->unsigned()->nullable();
            $table->foreign('claimed_by')->references('id')->on('staff');
            $table->integer('leader_id')->unsigned()->unique();
            $table->foreign('leader_id')->references('id')->on('users');
            $table->text('general_rules');
            $table->text('prize_rules');
            $table->text('miscellaneous_rules');
        });
    }

}

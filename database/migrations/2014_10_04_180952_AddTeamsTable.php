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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('team_id');
            $table->dropColumn('team_id');
        });
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
            $table->string('repo_name')->unique()->nullable();
            $table->integer('leader_id')->unsigned()->unique();
            $table->foreign('leader_id')->references('id')->on('users');
            $table->text('general_rules');
            $table->text('prize_rules');
            $table->text('miscellaneous_rules');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->integer('team_id')->unsigned()->nullable();
            $table->foreign('team_id')->references('id')->on('teams');
        });
    }

}

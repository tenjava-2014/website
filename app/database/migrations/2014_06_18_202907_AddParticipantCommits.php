<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParticipantCommits extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('participant_commits', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("message", 50);
            $table->string("hash", 40);
            $table->unsignedInteger("app_id");
            $table->string("repo");
            $table->foreign("app_id")->references("id")->on("applications");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('participant_commits');
    }

}

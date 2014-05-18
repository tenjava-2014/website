<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddApplications extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('applications', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("gh_username");
            $table->string("dbo_username");
            $table->string("github_email");
            $table->string("irc_username")->nullable();
            $table->string("mc_username")->nullable();
            $table->string("gmail")->nullable();
            $table->boolean("judge")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('applications');
    }

}

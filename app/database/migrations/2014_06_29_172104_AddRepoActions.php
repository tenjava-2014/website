<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepoActions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('repo_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string("repo_name");

            $table->unsignedInteger("app_id");
            $table->foreign("app_id")->references("id")->on("applications");

            $table->string("action");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('repo_actions');
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveForiegnKeyRepoActions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('repo_actions', function (Blueprint $table) {
            $table->dropForeign("repo_actions_app_id_foreign");
            $table->dropColumn("app_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('repo_actions', function (Blueprint $table) {
            $table->unsignedInteger("app_id");
            $table->foreign("app_id")->references("id")->on("applications");
        });
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepoName extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('judge_claims', function (Blueprint $table) {
            $table->string("repo_name")->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('judge_claims', function (Blueprint $table) {
            $table->dropColumn("repo_name");
        });
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJudgeresults extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('judge_results', function (Blueprint $table) {
            /* Bootstrap */
            $table->increments('id');
            $table->timestamps();

            /* Foreign keys */
            $table->unsignedInteger("claim_id");
            $table->foreign("claim_id")->references("id")->on("judge_claims");

            /** @see https://github.com/tenjava/resources/wiki/Judging-criteria */

            /* Scores for Idea category */
            $table->integer("idea_originality");
            $table->integer("idea_theme_conformance");
            $table->integer("idea_complexity");
            $table->integer("idea_fun");
            $table->integer("idea_expansion");

            /* Scores for Execution category */
            $table->integer("execution_user_friendliness");
            $table->integer("execution_absence_bugs");
            $table->integer("execution_general_mechanics");

            /* Scores for Code category */
            $table->integer("code_bukkit_api");
            $table->integer("code_java");
            $table->integer("will do
            ");

            /* Email phrases */
            $table->text("liked");
            $table->text("improve");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('judge_results');
    }

}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalJudgeOptions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('judges', function (Blueprint $table) {
            $table->boolean("show_on_judge_page");
            $table->boolean("enabled");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('judges', function (Blueprint $table) {
            $table->dropColumn(["enabled", "show_on_judge_page"]);
        });
    }

}

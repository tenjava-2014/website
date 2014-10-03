<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJudgeWebTeamOption extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('judges', function (Blueprint $table) {
            $table->boolean("web_team")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('judges', function (Blueprint $table) {
            $table->dropColumn("web_team");
        });
    }

}

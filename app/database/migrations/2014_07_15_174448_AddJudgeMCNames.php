<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJudgeMCNames extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('judges', function (Blueprint $table) {
            $table->string("minecraft_username");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('judges', function (Blueprint $table) {
            $table->dropColumn("minecraft_username");
        });
    }

}

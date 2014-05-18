<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddStreamURL extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('applications', function (Blueprint $table) {
            $table->string("twitch_username")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn("twitch_username");
        });
    }

}

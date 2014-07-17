<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOversightOrigin extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('oversight_requests', function (Blueprint $table) {
            $table->unsignedInteger("judge_id");
            $table->foreign("judge_id")->references("id")->on("judges");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('oversight_requests', function (Blueprint $table) {
            $table->dropColumn("judge_id");
        });
    }

}

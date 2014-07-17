<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOversightForeignKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('oversight_requests', function (Blueprint $table) {
            $table->foreign("claim_id")->references("id")->on("judge_claims");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('oversight_requests', function (Blueprint $table) {
            $table->dropIndex("oversight_requests_claim_id_foreign");
        });
    }

}

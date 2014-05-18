<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SwitchToText extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn("github_email");
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->text("github_email");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn("github_email");
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->string("github_email");
        });
    }

}

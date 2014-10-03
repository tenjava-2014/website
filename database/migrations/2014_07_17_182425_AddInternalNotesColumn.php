<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInternalNotesColumn extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('judge_results', function (Blueprint $table) {
            $table->text("internal_notes")->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('judge_results', function (Blueprint $table) {
            $table->dropColumn("internal_notes");
        });
    }

}

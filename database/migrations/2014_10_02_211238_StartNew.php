<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class StartNew extends Migration {

    /**
     * Reverse the migrations.
     *
     * @throws Exception
     * @return void
     */
    public function down() {
        throw new Exception('This cannot be done.');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        // Drop everything but failed_jobs, migrations, and subscriptions
        Schema::dropIfExists('applications');
        Schema::dropIfExists('judge_claims');
        Schema::dropIfExists('judge_results');
        Schema::dropIfExists('judges');
        Schema::dropIfExists('online_streams');
        Schema::dropIfExists('oversight_requests');
        Schema::dropIfExists('participant_commits');
        Schema::dropIfExists('participant_feedback');
        Schema::dropIfExists('participant_times');
        Schema::dropIfExists('repo_actions');
        Schema::dropIfExists('user_avatars');
    }

}

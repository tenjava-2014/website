<?php

namespace TenJava\Controllers\Judging;

use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\JudgeClaim;
use View;

class ReviewController extends BaseJudgingController {

    public function displayResultsForParticipant($repoName) {
        // We'll be given a repo name such as lol768-t1 here.
        // Let's grab all of the claims which match this repo name

        $claims = JudgeClaim::with(["judge", "result"])->whereRepoName($repoName)->get();
        return View::make("judging.pages.result-view", ["claims" => $claims]);
    }
}
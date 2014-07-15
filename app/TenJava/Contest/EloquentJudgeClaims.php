<?php
namespace TenJava\Contest;

use Log;
use TenJava\Models\ExposedJudge;
use TenJava\Models\Judge;

class EloquentJudgeClaims implements JudgeClaimsInterface {

    public function getClaimsForJudge($judgeId) {
        Log::info("Instructed to get claims...");
        return Judge::with("claims")->where("id", $judgeId)->first()/*->claims()*/;
    }

    public function getAllJudgesWithClaims() {
        return ExposedJudge::with("claims")->get();
    }
}
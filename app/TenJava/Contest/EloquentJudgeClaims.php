<?php
namespace TenJava\Contest;

use Log;
use TenJava\Models\ExposedJudge;
use TenJava\Models\Judge;

class EloquentJudgeClaims implements JudgeClaimsInterface {

    public function getClaimsForJudge($judgeId) {
        Log::info("Instructed to get claims...");
        $judge = Judge::with("claims.result")->where("id", $judgeId)->firstOrFail();
        Log::info("Got judge " . json_encode($judge->toArray()));
        return $judge->claims;
    }

    public function getAllJudgesWithClaims() {
        return ExposedJudge::with("claims")->get();
    }
}
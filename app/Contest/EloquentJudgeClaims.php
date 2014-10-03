<?php
namespace TenJava\Contest;

use Log;
use TenJava\Models\ExposedJudge;
use TenJava\Models\Judge;

class EloquentJudgeClaims implements JudgeClaimsInterface {

    public function getClaimsForJudge($judgeId) {
        $judge = Judge::with("claims.result")->where("id", $judgeId)->firstOrFail();
        return $judge->claims;
    }

    public function getAllJudgesWithClaims() {
        return ExposedJudge::with("claims.result")->get();
    }
}
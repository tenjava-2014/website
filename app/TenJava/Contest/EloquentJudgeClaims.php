<?php
namespace TenJava\Contest;

use TenJava\Models\ExposedJudge;
use TenJava\Models\Judge;

class EloquentJudgeClaims implements JudgeClaimsInterface {

    public function getClaimsForJudge($judgeId) {
        return Judge::with("claims")->whereId($judgeId)->claims();
    }

    public function getAllJudgesWithClaims() {
        return ExposedJudge::with("claims")->get();
    }
}
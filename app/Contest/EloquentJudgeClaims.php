<?php
namespace TenJava\Contest;

use Log;
use TenJava\Models\ExposedJudge;
use TenJava\Models\Judge;
use TenJava\Staff;

class EloquentJudgeClaims implements JudgeClaimsInterface {

    public function getClaimsForJudge($judgeId) {
        $judge = Staff::judge()->with('claims')->where('id', $judgeId)->firstOrFail();
        return $judge->claims;
    }

    public function getAllJudgesWithClaims() {
        return Staff::judge()->with('claims.team')->get();
    }
}

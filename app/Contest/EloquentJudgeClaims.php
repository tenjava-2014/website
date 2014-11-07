<?php namespace TenJava\Contest;

use Log;
use TenJava\Staff;

class EloquentJudgeClaims implements JudgeClaimsInterface {

    public function getAllJudgesWithClaims() {
        return Staff::judge()->with('claims.team')->get();
    }

    public function getClaimsForJudge($judgeId) {
        $judge = Staff::judge()->with('claims')->where('id', $judgeId)->firstOrFail();
        return $judge->claims;
    }
}

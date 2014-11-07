<?php namespace TenJava\Contest;

interface JudgeClaimsInterface {
    public function getAllJudgesWithClaims();

    public function getClaimsForJudge($judgeId);
}

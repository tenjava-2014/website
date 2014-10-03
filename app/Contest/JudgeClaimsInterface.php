<?php
namespace TenJava\Contest;

interface JudgeClaimsInterface {
    public function getClaimsForJudge($judgeId);
    public function getAllJudgesWithClaims();
}
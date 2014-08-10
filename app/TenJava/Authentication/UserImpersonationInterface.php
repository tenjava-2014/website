<?php
namespace TenJava\Authentication;

interface UserImpersonationInterface {

    /**
     * @return bool If the user is currently impersonating a judge.
     */
    public function isImpersonatingJudge();

    /**
     * @return int The judge ID in the database.
     */
    public function getJudgeId();

    /**
     * @return string The judge's username.
     */
    public function getJudgeUsername();

    /**
     * @return int The judge's auth provider id.
     */
    public function getJudgeAuthId();

    /**
     * @param $judgeId
     * @param $username
     * @param $judgeAuthId
     * @return void
     */
    public function startImpersonation($judgeId, $username, $judgeAuthId);
}
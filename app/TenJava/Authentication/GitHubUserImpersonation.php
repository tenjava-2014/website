<?php
namespace TenJava\Authentication;

use Illuminate\Session\Store as SessionStore;

class GitHubUserImpersonation implements UserImpersonationInterface {

    /**
     * @var SessionStore
     */
    private $store;

    public function __construct(SessionStore $store) {
        $this->store = $store;
    }

    public function isImpersonatingJudge() {
        return $this->store->has("impersonation");
    }

    public function getJudgeId() {
        return $this->store->get("impersonation.judge_id");
    }

    public function getJudgeUsername() {
        return $this->store->get("impersonation.judge_username");
    }

    public function getJudgeAuthId() {
        return $this->store->get("impersonation.auth_id");
    }

    public function startImpersonation($judgeId, $username, $judgeAuthId) {
        $this->store->set("impersonation", ["judge_id" => $judgeId, "judge_username" => $username, "auth_id" => $judgeAuthId]);
    }
}
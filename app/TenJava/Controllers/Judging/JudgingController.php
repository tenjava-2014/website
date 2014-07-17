<?php

namespace TenJava\Controllers\Judging;


use Session;
use Input;
use Log;
use Redirect;
use Response;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use View;

class JudgingController extends BaseJudgingController {

    public function showLatestPlugin() {
        $this->setActive("Judge");
        $this->setPageTitle("Judging");
        if (count($this->judgeClaims['pending']) > 0) {
            return View::make("judging.pages.judge", ["claim" => $this->judgeClaims['pending'][0]]);
        } else {
            return Redirect::to("/judging");
        }
    }

    public function judgePlugin() {
        $claimId = Input::get("claim_id");
        $claimOk = $this->isClaimOk($claimId);
        return Response::json((bool) $claimOk);
    }

    private function isClaimOk($claimId) {
        Log::info("Starting claim check for $claimId");
        if (count($this->judgeClaims['pending']) > 0) {
            Log::info("If passed");
            foreach ($this->judgeClaims['pending'] as $claim) {
                Log::info("Got claim {$claim->id}");
                if ($claim->id == $claimId) {
                    Log::info("Claim matches");
                    return true;
                } else {
                    Log::info("Claim doesn't match");
                }
            }
        }
        return false;
    }

    public function toggleInputMethod() {
        if (Session::has("judge-use-num")) {
            Session::forget("judge-use-num");
        } else {
            Session::put("judge-use-num", true);
        }
        return Redirect::back();
    }

}
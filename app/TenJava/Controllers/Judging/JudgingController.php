<?php

namespace TenJava\Controllers\Judging;


use Input;
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
        if (count($this->judgeClaims['pending']) > 0) {
            foreach ($this->judgeClaims['pending'] as $claim) {
                if ($claim->id == $claimId) {
                    return true;
                }
            }
        }
        return false;
    }

}
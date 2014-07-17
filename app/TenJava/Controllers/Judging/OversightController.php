<?php

namespace TenJava\Controllers\Judging;


use Input;
use Redirect;
use Response;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\JudgeClaim;
use TenJava\Models\OversightRequest;
use Validator;
use View;

class OversightController extends BaseJudgingController {

    public function showOversight() {
        $this->setActive("Oversight");
        $this->setPageTitle("Oversight");
        return View::make("judging.pages.oversight");
    }

    public function showOversightForm($id) {
        $this->setActive("Oversight");
        $this->setPageTitle("Requesting oversight");
        if (!$this->isClaimOk($id)) {
            return Response::json("Invalid claim.");
        }

        $claim = JudgeClaim::findOrFail($id);
        return View::make("judging.pages.oversight", ["claim" => $claim]);
    }

    public function processOversight($id) {
        if (!$this->isClaimOk($id)) {
            return Response::json("Invalid claim.");
        }
        $claim = JudgeClaim::findOrFail($id);
        /** @var $claim JudgeClaim */
        if ($claim->result != null) {
            return Response::json("You already judged..");
        }

        $validator = Validator::make(
            ["reason" => Input::get("reason")],
            [
                "reason" => "required|min:4",
            ],
            [
                "reason.required" => "Please provide detailed information about the issue..",
                "reason.min" => "Please put more effort into your report.",
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $oversight = new OversightRequest(Input::all());
        $oversight->claim_id = $id;
        $oversight->save();
        return Redirect::to("/judging");
    }
}

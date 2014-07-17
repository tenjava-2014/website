<?php

namespace TenJava\Controllers\Judging;


use Session;
use Input;
use Log;
use Redirect;
use Response;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\JudgeResult;
use Validator;
use View;

class JudgingController extends BaseJudgingController {

    public function showLatestPlugin() {
        $this->setActive("Judge");
        $this->setPageTitle("Judging");
        if (count($this->judgeClaims['pending']) > 0) {
            $viewData = ["claim" => $this->judgeClaims['pending'][0]];
            if ($this->auth->getJudgeId() % 15 == 0) {
                $viewData['altCats'] = true;
            }
            return View::make("judging.pages.judge", $viewData);
        } else {
            return Redirect::to("/judging");
        }
    }

    public function judgePlugin() {
        // I'm going on holiday tomorrow so this won't be pretty
        $claimId = Input::get("claim_id");
        $claimOk = $this->isClaimOk($claimId);
        if (!$claimOk) {
            return Response::json("Invalid claim.");
        }
        $fieldNames = ["liked", "improve", "idea_originality", "idea_theme_conformance", "idea_complexity", "idea_fun", "idea_expansion", "execution_user_friendliness", "execution_absence_bugs", "execution_general_mechanics", "code_bukkit_api", "code_java", "code_documentation"];
        $dataSource = [];
        foreach ($fieldNames as $field) {
            $dataSource[$field] = Input::get($field);
        }
        $validator = Validator::make(
            $dataSource,
            [
                "idea_originality" => "required|integer|min:0|max:15",
                "idea_theme_conformance" => "required|integer|min:0|max:30",
                "idea_complexity" => "required|integer|min:0|max:10",
                "idea_fun" => "required|integer|min:0|max:10",
                "idea_expansion" => "required|integer|min:0|max:10",

                "execution_user_friendliness" => "required|integer|min:0|max:20",
                "execution_absence_bugs" => "required|integer|min:0|max:20",
                "execution_general_mechanics" => "required|integer|min:0|max:35",

                "code_bukkit_api" => "required|integer|min:0|max:40",
                "code_java" => "required|integer|min:0|max:40",
                "code_documentation" => "required|integer|min:0|max:20",
                "liked" => "required|min:4",
                "improve" => "required|min:4",
            ],
            [
                "liked.required" => "Please provide a short phrase/sentence that describes what you liked about the submission.",
                "improve.required" => "Please provide a short phrase/sentence that describes what you thought could be improved about the submission.",
                "liked.min" => "Please put more effort into your liked phrase.",
                "improve.min" => "Please put more effort into your improvement phrase.",
            ]);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $judgeResult = new JudgeResult(Input::all());
        $judgeResult->claim_id = $claimId;
        $judgeResult->save();
        return Redirect::to("/judging/plugins");
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
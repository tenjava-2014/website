<?php


namespace TenJava\Controllers\Judging;


use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Models\ParticipantFeedback;
use View;

class ViewFeedbackController extends BaseJudgingController {
    public function showFeedback() {
        $feedbacks = ParticipantFeedback::with("participant")->orderBy("id", "desc")->paginate(5);
        $this->setPageTitle("Feedback viewer");
        return View::make("judging.pages.feedback", ["feedbacks" => $feedbacks]);
    }
} 
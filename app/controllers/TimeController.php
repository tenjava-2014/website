<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;

class TimeController extends BaseController {

    public function showUserTimes() {
        $githubUsername = $this->auth->getUsername();
        $ghId = $this->auth->getUserId();
        $appCount = Application::where("gh_id", $ghId)->where("judge", false)->count();
        if ($appCount == 0) {
            $errorController = App::make("ErrorController");
            return $errorController->priorapp();
        }
        return View::make("pages.forms.time-selection")->with(array("username" => $githubUsername));
    }

    public function confirmUserTimes() {
        $ghId = $this->auth->getUserId();
        $app = Application::where("gh_id", $ghId)->first();

        if ($app === null) {
            $errorController = App::make("ErrorController");
            return $errorController->priorapp();
        }
        $existing = ParticipantTimes::where("user_id", $app->id)->first();
        $rbOpt = Input::get("rb");
        $validator = Validator::make(
            array(
                'time' => $rbOpt,
                'no-existing' => $existing ? 0 : 1,
            ),
            array(
                'time' => 'required|in:t1,t2,t3,t1t2,t1t3',
                "no-existing" => "accepted"
            ),
            array(
                'time.required' => 'No time selected.',
                'time.in' => 'Unacceptable time provided.',
                'no-existing.accepted' => "Existing time entry exists. Contact an organizer."
            )
        );

        if ($validator->fails()) {
            return Redirect::to("/times/select")->withErrors($validator);
        }
        $pt = new ParticipantTimes();
        $pt->user_id = $app->id;
        $pt->t1 = (str_contains($rbOpt, "t1"));
        $pt->t2 = (str_contains($rbOpt, "t2"));
        $pt->t3 = (str_contains($rbOpt, "t3"));
        $pt->save();
        Queue::push('TimeSelectionJob', array('username' => $this->auth->getUsername(), 't1' => $pt->t1, "t2" => $pt->t2, "t3" => $pt->t3));
        return Redirect::to("/times/thanks");
    }

    public function showThanks() {
        $ghId = $this->auth->getUserId();
        $app = Application::where("gh_id", $ghId)->first();
        if ($app === null) {
            $errorController = App::make("ErrorController");
            return $errorController->priorapp();
        }
        $existing = ParticipantTimes::where("user_id", $app->id)->first();
        if ($existing === null) {
            return Redirect::to("/times/select");
        }
        return View::make("pages.result.thanks.times")->with(array("entry" => $existing));
    }

}
<?php namespace TenJava\Http\Controllers\Application;

use App;
use Input;
use Queue;
use Redirect;
use TenJava\Http\Controllers\Abstracts\BaseController;
use TenJava\Http\Controllers\ErrorController;
use Validator;
use View;

class TimeController extends BaseController {

    /**
     * @var \TenJava\Http\Controllers\ErrorController
     */
    private $errorController;

    public function __construct(ErrorController $errorController) {
        parent::__construct();
        $this->errorController = $errorController;
    }

    public function confirmUserTimes() {
        $ghId = $this->auth->getUserId();
        $app = Application::where('gh_id', $ghId)->first();

        if ($app === null) {
            return $this->errorController->priorapp();
        }
        $existing = ParticipantTimes::where('user_id', $app->id)->first();
        $rbOpt = Input::get('rb');
        $validator = Validator::make(
            [
                'time' => $rbOpt,
                'no-existing' => $existing ? 0 : 1,
                'closed' => null,
            ],
            [
                'time' => 'required|in:t1,t2,t3,t1t2,t1t3',
                'no-existing' => 'accepted',
                'closed' => 'required'
            ],
            [
                'time.required' => 'No time selected.',
                'time.in' => 'Unacceptable time provided.',
                'no-existing.accepted' => 'Existing time entry exists. Contact an organizer.',
                'closed.required' => "Sorry, it's too late to choose a time."
            ]
        );

        if ($validator->fails()) {
            return Redirect::to('/times/select')->withErrors($validator);
        }
        $pt = new ParticipantTimes();
        $pt->user_id = $app->id;
        $pt->t1 = (str_contains($rbOpt, 't1'));
        $pt->t2 = (str_contains($rbOpt, 't2'));
        $pt->t3 = (str_contains($rbOpt, 't3'));
        $pt->save();
        Queue::push('\TenJava\QueueJobs\TimeSelectionJob', ['username' => $this->auth->getUsername(), 't1' => $pt->t1, 't2' => $pt->t2, 't3' => $pt->t3]);
        return Redirect::to('/times/thanks');
    }

    public function showThanks() {
        $ghId = $this->auth->getUserId();
        $app = Application::where('gh_id', $ghId)->first();
        if ($app === null) {
            return $this->errorController->priorapp();
        }
        $existing = ParticipantTimes::where('user_id', $app->id)->first();
        if ($existing === null) {
            return Redirect::to('/times/select');
        }
        return View::make('pages.result.thanks.times')->with(['entry' => $existing]);
    }

    public function showUserTimes() {
        $this->setActive('Choose Time');
        $this->setPageTitle('Choose contest time');
        $githubUsername = $this->auth->getUsername();
        $ghId = $this->auth->getUserId();
        $appCount = Application::where('gh_id', $ghId)->where('judge', false)->count();
        if ($appCount == 0) {
            return $this->errorController->priorapp();
        }
        $app = Application::where('gh_id', $ghId)->first();
        $existing = ParticipantTimes::where('user_id', $app->id)->first();
        return View::make('pages.forms.time-selection')->with(['username' => $githubUsername, 'existing' => $existing]);
    }

}

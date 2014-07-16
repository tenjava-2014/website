<?php
namespace TenJava\Controllers\Pages;

use Input;
use Redirect;
use TenJava\Contest\ParticipantRepositoryInterface;
use TenJava\Controllers\Abstracts\BaseController;
use Response;
use TenJava\Models\Application;
use TenJava\Models\ParticipantFeedback;
use Validator;
use View;

class FeedbackController extends BaseController {
    /**
     * @var ParticipantRepositoryInterface
     */
    private $participants;

    /**
     * @param ParticipantRepositoryInterface $participants
     */
    public function __construct(ParticipantRepositoryInterface $participants) {
        parent::__construct();
        $this->participants = $participants;
    }

    public function showFeedback() {
        $this->setPageTitle("Provide feedback");
        $viewData = ["tookPart" => $this->userTookPart()];


        return Response::view('pages.forms.feedback', $viewData);
    }

    private function userTookPart() {
        $gitHubId = $this->auth->getUserId();
        $app = $this->participants->getParticipantByAuthId($gitHubId);
        /** @var $app Application */
        if ($app != null) {
            return ($app->commits->count() > 0);
        }
        return false;
    }

    public function sendFeedback() {
        $validator = Validator::make(
            array(
                'feedback' => Input::get("comment"),
                'tookpart' => $this->userTookPart(),
            ),
            array(
                'feedback' => 'required|max:65536',
                'tookpart' => 'required'
            ),
            array(
                'feedback.max' => "Feedback must be less than 2^16 characters in length.",
                'feedback.required' => "Sorry, you didn't supply any feedback.",
                'tookpart.required' => "Sorry, you didn't take part."
            )
        );

        if ($validator->fails()) {
            return Redirect::to("/feedback")->withErrors($validator)->withInput();
        }
        $feedback = new ParticipantFeedback(Input::all());
        $feedback->app_id = Application::where("gh_id", $this->auth->getUserId())->firstOrFail()->id;
        $feedback->save();

        return View::make("pages.result.thanks.feedback");
    }

} 
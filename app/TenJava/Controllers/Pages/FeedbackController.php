<?php
namespace TenJava\Controllers\Pages;

use Redirect;
use TenJava\Contest\ParticipantRepositoryInterface;
use TenJava\Controllers\Abstracts\BaseController;
use Response;
use TenJava\Models\Application;
use Validator;

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
        $viewData = ["tookPart" => false];

        $gitHubId = $this->auth->getUserId();
        $app = $this->participants->getParticipantByAuthId($gitHubId);
        /** @var $app Application */
        if ($app != null) {
            if ($app->commits->count() > 0) {
                $viewData["tookPart"] = true;
            }
        }
        return Response::view('pages.forms.feedback', $viewData);
    }

    public function sendFeedback() {
        $validator = Validator::make(
            array(
                'feedback' => Input::get("feedback"),
            ),
            array(
                'feedback' => 'required|max:65536',
            ),
            array(
                'feedback.max' => "Feedback must be less than 2^16 characters in length.",
                'feedback.required' => "Sorry, you didn't supply any feedback."
            )
        );
        return Redirect::to("/");
    }

} 
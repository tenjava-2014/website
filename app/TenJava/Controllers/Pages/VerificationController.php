<?php
namespace TenJava\Controllers\Pages;

use Input;
use TenJava\Contest\TwitchRepositoryInterface;
use TenJava\Controllers\Abstracts\BaseController;
use Carbon\Carbon;
use Config;
use TenJava\Models\ParticipantCommit;
use TenJava\Repository\ParticipantCommitRepositoryInterface;
use TenJava\Security\HmacCreationInterface;
use TenJava\Time\ContestTimesInterface;
use View;

class VerificationController extends BaseController {
    /**
     * @var HmacCreationInterface
     */
    private $hmac;

    /**
     * @param HmacCreationInterface $hmac
     */
    public function __construct(HmacCreationInterface $hmac) {
        parent::__construct();
        $this->hmac = $hmac;
    }

    public function getVerificationKey() {
        $this->setPageTitle("Verification Key");
        $data = $this->auth->getUserId() . "-" . $this->auth->getUsername();
        $key = $this->hmac->createSignature($data, Config::get("gh-data.verification-key"));
        return View::make("pages.dynamic.winner-verification")->with(["key" => $key]);
    }

}

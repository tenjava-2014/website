<?php
namespace TenJava\Controllers\Abstracts;

use App;
use Config;
use Github\Client;
use Illuminate\Routing\Controller;
use Log;
use TenJava\Contest\JudgeClaimsInterface;
use TenJava\Contest\ParticipantRepositoryInterface;
use TenJava\Models\JudgeClaim;
use TenJava\Models\ParticipantTimes;
use View;
use TenJava\Tools\UI\NavigationItem;
use TenJava\Models\Application;
use TenJava\Authentication\AuthProviderInterface;

abstract class BaseJudgingController extends BaseController {

    const BASE_TITLE = "ten.java judging";

    /**
     * @var JudgeClaimsInterface
     */
    private $claimsInterface;

    protected $judgeClaims;
    /**
     * @var ParticipantRepositoryInterface
     */
    private $participants;

    public function __construct(JudgeClaimsInterface $claimsInterface, ParticipantRepositoryInterface $participants) {
        parent::__construct();
        $this->claimsInterface = $claimsInterface;
        $this->shareClaims();
        $this->participants = $participants;
    }

    public function getNavigation() {

        $navigation['primary'] = array(
            new NavigationItem("Dashboard", "/judging"),
            new NavigationItem("Judge", "/judging/plugins"),
            new NavigationItem("Logs", "/judging/logs"),
            new NavigationItem("Oversight", "/judging/oversight"),
            new NavigationItem("Help", "/judging/help"),
        );

        foreach ($navigation['primary'] as $navItem) {
            /** @var $navItem \TenJava\Tools\UI\NavigationItem */
            if (starts_with(strtolower($navItem->getTitle()), strtolower($this->activeNavTitle))) {
                $navItem->setActive();
            }
        }
        return $navigation;
    }

    /**
     * @return string The current page title.
     */
    public function getPageTitle() {
        return ($this->pageTitle == "") ? self::BASE_TITLE : $this->pageTitle . " - " . self::BASE_TITLE;
    }

    private function processClaims($claims) {
        $claimData = ["total" => 0, "done" => [], "pending" => []];
        foreach ($claims as $claim) {
            /** @var $claim JudgeClaim */
            if ($claim->result != null) {
                $claimData['done'][] = $claim;
            } else {
                $claimData['pending'][] = $claim;
            }
            $claimData['total'] += 1;
        }
        return $claimData;
    }

    private function shareClaims() {
        $this->judgeClaims = $this->processClaims($this->claimsInterface->getClaimsForJudge($this->auth->getJudgeId()));
        $turnout = [];
        $turnout['total'] = $this->participants->getParticipantCount();
        $turnout['real'] = $this->participants->getParticipantsWithCommitCount();
        View::share("turnout", $turnout);
        View::share("claims", $this->judgeClaims);
    }
}
<?php
namespace TenJava\Controllers\Abstracts;

use App;
use Config;
use Github\Client;
use Illuminate\Routing\Controller;
use Log;
use TenJava\Contest\JudgeClaimsInterface;
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

    public function __construct(JudgeClaimsInterface $claimsInterface) {
        parent::__construct();
        $this->claimsInterface = $claimsInterface;
        $this->shareClaims();
    }

    public function getNavigation() {

        $navigation['primary'] = array(
            new NavigationItem("Dashboard", "/judging"),
            new NavigationItem("Assigned plugins", "/judging/plugins"),
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

    private function processClaims() {
        $claimData = ["total" => 0, "done" => [], "pending" => []];
        $claims = $this->judgeClaims;
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
    }
}
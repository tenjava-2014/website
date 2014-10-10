<?php
namespace TenJava\Http\Controllers\Abstracts;

use App;
use Auth;
use Config;
use Illuminate\Routing\Controller;
use Log;
use TenJava\Contest\JudgeClaimsInterface;
use TenJava\Contest\ParticipantRepositoryInterface;
use TenJava\Team;
use TenJava\Tools\UI\NavigationItem;
use View;

abstract class BaseJudgingController extends BaseController {

    const BASE_TITLE = 'ten.java judging';
    protected $judgeClaims;
    /**
     * @var JudgeClaimsInterface
     */
    private $claimsInterface;
    /**
     * @var ParticipantRepositoryInterface
     */
    private $participants;

    public function __construct(JudgeClaimsInterface $claimsInterface, ParticipantRepositoryInterface $participants) {
        parent::__construct();
        $this->claimsInterface = $claimsInterface;
        $this->participants = $participants;
        $this->shareClaims();
    }

    private function shareClaims() {
        $this->judgeClaims = $this->processClaims($this->claimsInterface->getClaimsForJudge(Auth::user()->staff->id));
        $turnout = [];
        $turnout['total'] = $this->participants->getParticipantCount();
        $turnout['real'] = $this->participants->getParticipantsWithCommitCount();
        View::share('turnout', $turnout);
        View::share('claims', $this->judgeClaims);
    }

    private function processClaims($claims) {
        // TODO: Make results
        $claimData = ['total' => 0, 'done' => [], 'pending' => []];
        foreach ($claims as $claim) {
            /** @var $claim Team */
            if ($claim->result != null) {
                $claimData['done'][] = $claim;
            } else {
                $claimData['pending'][] = $claim;
            }
            $claimData['total'] += 1;
        }
        return $claimData;
    }

    public function getNavigation() {

        $navigation['primary'] = array(
            new NavigationItem('Dashboard', '/judging'),
            new NavigationItem('Judge', '/judging/plugins'),
            new NavigationItem('Logs', '/judging/logs'),
            new NavigationItem('Oversight', '/judging/oversight'),
            new NavigationItem('Help', '/judging/help'),
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

    protected function isClaimOk($claimId) {
        Log::info('Starting claim check for $claimId');
        if (count($this->judgeClaims['pending']) > 0) {
            Log::info('If passed');
            foreach ($this->judgeClaims['pending'] as $claim) {
                Log::info("Got claim {$claim->id}");
                if ($claim->id == $claimId) {
                    Log::info('Claim matches');
                    return true;
                } else {
                    Log::info("Claim doesn't match");
                }
            }
        }
        return false;
    }
}
